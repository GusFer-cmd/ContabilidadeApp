<?php

namespace App\Repositories\Eloquent;

use App\Models\Renter;
use App\Repositories\Interfaces\IRenterRepository;
use Illuminate\Support\Collection;

class RenterRepository implements IRenterRepository
{
    public function getAll(): Collection
    {
        return Renter::all();
    }
    
    public function getById(int $id): ?Renter
    {
        return Renter::find($id);
    }

    public function create(array $data): Renter
    {
        return Renter::create($data);
    }

    public function update(Renter &$renter, array $data): bool
    {
        return $renter->update($data);
    }

    public function delete(Renter $renter): ?bool
    {
        return $renter->delete();
    }
}