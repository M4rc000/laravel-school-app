<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as facReq;
// use Illuminate\Support\Facades\Request;



class HomeController extends Controller
{
    public function __construct()
    {
        // Share data across all views in this controller
        view()->share('path', facReq::path());
    }

    public function index(){
        return view('home.admin.index',[
            'title' => 'Home',
        ]);
    }

    public function manage_user(){
        return view('home.admin.manage-user',[
            'title' => 'Manage User',
            // 'path' => facReq::path()
        ]);
    }

    public function manage_menu(){
        return view('home.admin.manage-menu',[
            'title' => 'Manage Menu',
        ]);
    }

    public function menus_all(){
        $menus = Menu::all();
        return response()->json($menus);
    }
    
    public function users_all(){
        $users = User::all();
        return response()->json($users);
    }

    public function manage_submenu(){
        return view('home.admin.manage-submenu',[
            'title' => 'Manage Submenu',
        ]);
    }

    public function profile(){
        return view('home.user.profile',[
            'title' => 'Profile',
            'user' => auth()->user(),
        ]);
    }

    public function settings(){
        return view('home.user.settings',[
            'title' => 'Settings',
        ]);
    }
}
