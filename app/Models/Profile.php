<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $fillable = ['name', 'admin_id', 'first_name', 'image', 'status'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
