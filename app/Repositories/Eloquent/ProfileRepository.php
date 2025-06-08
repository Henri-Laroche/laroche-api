<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProfileRepositoryInterface;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function all(): Collection|array
    {
        return Profile::where('status', 'ativo')->get();
    }

    public function create(array $data): Profile
    {
        return Profile::create($data);
    }

    public function update(int $id, array $data): ?Profile
    {
        $profile = Profile::find($id);
        if ($profile) {
            $profile->update($data);
        }
        return $profile;
    }

    public function delete(int $id): bool
    {
        return Profile::destroy($id) > 0;
    }

    public function find(int $id): ?Profile
    {
        return Profile::find($id);
    }
}
