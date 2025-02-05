<?php

namespace App\Services;

use App\Exceptions\RenterNotFoundException;
use App\Models\Renter;
use App\Repositories\Interfaces\IRenterRepository;
use Illuminate\Support\Collection;

class RenterService
{
    private IRenterRepository $repository;

    public function __construct(IRenterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function getById(int $id): ?Renter
    {
        $renter = $this->repository->getById($id);
        if ($renter === null)
            throw new RenterNotFoundException();

        return $renter;
    }
    
    public function create(array $data): Renter 
    {

        $renter = $this->repository->create($data);

        return $renter;
    }

    public function update(array $data): Renter
    {
        $renter = $this->repository->getById($data['id']);
        
        $this->repository->update($renter, $data);
    
        return $renter;
    }

    public function delete(int $id)
    {
        $renter = $this->repository->getById($id);

        if ($renter === null)
            throw new RenterNotFoundException();

        return $this->repository->delete($renter);
    }
}