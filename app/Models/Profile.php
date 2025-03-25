<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(int $id)
 * @method static create(array $data)
 * @method static where(string $string, string $string1)
 * @method static factory()
 * @method static findOrFail(mixed $profile_id)
 * @property mixed $admin_id
 * @property mixed $id
 */
class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'nom',
        'first_name',
        'image',
        'status'
    ];

    /**
     * Un profil appartient à un administrateur.
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Un profil peut avoir plusieurs commentaires.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
