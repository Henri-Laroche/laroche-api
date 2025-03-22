<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $string1)
 * @method static findOrFail($id)
 */
class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['last_name', 'first_name', 'admin_id', 'image', 'status'];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
