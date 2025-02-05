<?php

namespace App\Services;

use App\Exceptions\InfoNotFoundException;
use App\Models\Info;
use App\Repositories\Interfaces\IInfoRepository;
use Illuminate\Support\Collection;

class InfoService
{
    private IInfoRepository $repository;

    public function __construct(IInfoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function getById(int $id): ?Info
    {
        $info = $this->repository->getById($id);
        if ($info === null)
            throw new InfoNotFoundException();

        return $info;
    }
    
    public function getByCardId(int $card_id): Collection
    {
        return $this->repository->getByCardId($card_id);
    }

    public function getByRenterId(int $renter_id): Collection
    {
        return $this->repository->getByRenterId($renter_id);
    }

    public function create(array $data): Info 
    {

        $info = $this->repository->create($data);

        return $info;
    }

    public function update(array $data): Info
    {
        $info = $this->repository->getById($data['id']);
        
        $this->repository->update($info, $data);
    
        return $info;
    }

    public function delete(int $id)
    {
        $info = $this->repository->getById($id);

        if ($info === null)
            throw new InfoNotFoundException();

        return $this->repository->delete($info);
    }
}