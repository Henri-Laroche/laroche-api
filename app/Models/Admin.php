<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
	use HasApiTokens;
    
	rotected $fillable = ['email', 'password'];
}
