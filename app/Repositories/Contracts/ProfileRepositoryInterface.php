<?php

namespace App\Repositories\Contracts;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;

interface ProfileRepositoryInterface
{
    public function all(): Collection|array;

    public function create(array $data): Profile;

    public function update(int $id, array $data): ?Profile;

    public function delete(int $id): bool;

    public function find(int $id): ?Profile;
}
