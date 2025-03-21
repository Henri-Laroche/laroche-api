<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
	use HasApiTokens;
    
	protected $fillable = ['email', 'password'];
}
