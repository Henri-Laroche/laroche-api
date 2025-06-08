<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $nom
 * @property mixed $first_name
 * @property mixed $image
 * @property mixed $admin_id
 * @property mixed $status
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class ProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'first_name' => $this->first_name,
            'image' => $this->image,
            'image_url' => $this->image ? Storage::disk('public')->url($this->image) : null,

            // Adiciona o campo status apenas se o usuário estiver autenticado
            $this->mergeWhen(auth('sanctum')->check(), [
                'status' => $this->status,
            ]),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
