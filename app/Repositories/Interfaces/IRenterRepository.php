<?php

namespace App\Repositories\Interfaces;

use App\Models\Renter;
use Illuminate\Support\Collection;

interface IRenterRepository
{
    public function getAll(): Collection;
    public function getById(int $id): ?Renter;
    public function create(array $data): Renter;
    public function update(Renter &$renter, array $data): bool;
    public function delete(Renter $renter): ?bool;
}