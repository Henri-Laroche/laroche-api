<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'admin_id', 'profile_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
