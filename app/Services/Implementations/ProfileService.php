<?php

namespace App\Services\Implementations;

use App\Models\Profile;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use App\Services\Contracts\ProfileServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class ProfileService implements ProfileServiceInterface
{
    protected ProfileRepositoryInterface $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function getActiveProfiles(): Collection|array
    {
        // Doit récupérer seulement les profils actifs
        return $this->profileRepository->all();
    }

    public function createProfile(array $data): Profile
    {
        return $this->profileRepository->create($data);
    }

    public function updateProfile(int $id, array $data): ?Profile
    {
        return $this->profileRepository->update($id, $data);
    }

    public function deleteProfile(int $id): bool
    {
        return $this->profileRepository->delete($id);
    }
}
