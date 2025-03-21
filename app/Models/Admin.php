<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
	use HasApiTokens, HasFactory;
    
	protected $fillable = ['name', 'email', 'password'];
	
	protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed',
    ];
}
