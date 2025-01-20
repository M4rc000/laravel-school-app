<?php

namespace App\Models;

use App\Models\UserRole;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;

class User extends Authenticatable
{
    use HasApiTokens; 
    use HasFactory;
    use Notifiable; 
    // use TwoFactorAuthenticatable;
    // use HasProfilePhoto;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function getProfilePhotoUrlAttribute()
    {
        // Your logic for retrieving the profile photo URL, e.g.:
        return $this->profile_photo_path ? asset('storage/' . $this->profile_photo_path) : null;
    }

    public function role(){
        return $this->belongsTo(UserRole::class);
    }
}
