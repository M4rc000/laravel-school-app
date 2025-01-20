<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $guarded = ['role_id'];

    public function user(){
        return $this->hasMany(User::class);
    }
}
