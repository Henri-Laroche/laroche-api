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
     * Um administrador pode ter vários perfis.
     */
    public function profile(): HasMany
    {
        return $this->hasMany(Profile::class);
    }

    /**
     * Um administrador pode ter vários comentários.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
