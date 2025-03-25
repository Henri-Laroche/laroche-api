<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static where(string $string, mixed $email)
 * @method static create(array $data)
 * @method static factory()
 * @property mixed $id
 */
class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Un administrateur peut avoir plusieurs profils.
     */
    public function profile(): HasMany
    {
        return $this->hasMany(Profile::class);
    }

    /**
     * Un administrateur peut avoir plusieurs commentaires.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
