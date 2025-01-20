<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller{
    public function index(){
        return view('auth.login', [
            'title' => 'Login',
            'email' => ''
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt authentication
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Check if email is verified
            if (!$user->email_verified_at) {
                return back()->with('loginError', 'Your email has not been verified.');
            }

            // Check if user is active
            if ($user->is_active == 0) {
                return back()->with('loginError', 'Your account is not active.');
            }

            // Attempt login
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/admin');
            }
        }

        return back()->with('loginError', 'Login failed! Please check your credentials.');
    }

    public function register(){
        return view('auth.register', [
            'title' => 'Register',
            'email' => '',
        ]);
    }

    public function store(Request $request): RedirectResponse{
        $validated = $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email:rfc|unique:users,email',
            'password' => 'required|min:5|max:255',
            'role_id' => 'required'
        ]);

        // Hash the password
        $validated['password'] = bcrypt($validated['password']);

        // Add additional fields
        $validated['picture'] = 'profile-img/default.jpg';
        $validated['remember_token'] = random_int(1000, 9999);
        $validated['created_by'] = 'System';
        $validated['updated_by'] = 'System';

        // Create the user
        $user = User::create($validated);

        session(['email' => $user->email]);

        // Redirect with success message
        return redirect('/auth')->with('success_registration', 'Successfully registered');
    }

    public function forgot_password(){
        return view('auth.forgotpassword', [
            'title' => 'Forgot password'
        ]);
    }

    public function check_email_forgot_password(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
        ]);

        if($request->email == ''){
            return redirect()->back()->with('invalid_email', 'Email is required!');
        }

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Generate an OTP or use the remember_token for verification
            $user->remember_token = rand(1000, 9999); // Example OTP generation
            $user->save(); // Save the generated OTP to the database

            // Prepare email data
            $email_data = [
                'otp' => $user->remember_token,
            ];

            session(['user' => $user]);

            // Send verification email
            Mail::to($user->email)->send(new VerifyEmail($email_data));

            // return redirect('verify-otp')->with('success_send_otp', 'Verification OTP code successfully sent to email!');
            return view('auth.verify-otp',[
                'title' => 'Verify OTP',
                'user' => $user,
                'success_send_otp' => 'Verification OTP code successfully sent to email!'
            ]);

        } else {
            return back()->with('NotFoundEmail', 'Email is not registered.');
        }
    }

    // public function verify_otp(){
    //     $user = session('user');

    //     return view('auth.verify-otp',[
    //         'title' => 'Verify OTP',
    //         'user' => $user
    //     ]);
    // }

    public function verifysendOTP(Request $request){
        $otp = $request->input('input-satu') . $request->input('input-dua') . $request->input('input-tiga') . $request->input('input-empat');

        // Retrieve the user from the session
        $user_id = $request->input('user_id');
        $user = User::find($user_id);

        // dd($user);

        // Check if the OTP matches
        if ($otp != $user->remember_token) {
            // OTP is incorrect
            return redirect()->back()->with(['otp_invalid' => 'Invalid OTP. Please try again.']);
        }

        return view('auth.forgot-new-password',[
            'title' => 'New password',
            'otp_valid' => 'Please set your new password',
            'user' => $user
        ]);
    }

    public function saveNewPassword(Request $request){
        $validated = $request->validate([
            'password' => 'required|min:5|max:255',
            'confirm-password' => 'required|min:5|max:255',
        ]);

        if($validated['password'] != $validated['confirm-password']){
            return redirect()->back()->with('invalid_password', 'Your password is not same or not valid');
        }

        $user = User::find($request->user_id);
        $user->password = bcrypt($validated['password']);
        $user->save();

        return redirect('/auth')->with('successfully_forgotpassword', 'Your password is successfully changed, Please login!');
    }

    public function logout(Request $request): RedirectResponse{
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
