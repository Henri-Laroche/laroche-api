<?php

namespace App\Services\Contracts;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;

interface ProfileServiceInterface
{
    public function getActiveProfiles(): Collection|array;

    public function createProfile(array $data): Profile;

    public function updateProfile(int $id, array $data): ?Profile;

    public function deleteProfile(int $id): bool;
}
