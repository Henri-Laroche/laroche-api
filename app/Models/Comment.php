<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, mixed $profile_id)
 * @method static create(array $data)
 * @method static factory()
 */
class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'profile_id',
        'admin_id',
        'content'
    ];

    /**
     * Um comentário pertence a um perfil.
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * Um comentário é criado por um administrador.
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
