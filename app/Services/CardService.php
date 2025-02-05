<?php

namespace App\Services;

use App\Exceptions\CardAlreadyCreated;
use App\Exceptions\CardNotFoundException;
use App\Models\Card;
use App\Repositories\Interfaces\ICardRepository;
use Illuminate\Support\Collection;

class CardService
{
    private ICardRepository $repository;

    public function __construct(ICardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function getById(int $id): ?Card
    {
        $card = $this->repository->getById($id);
        if ($card === null)
            throw new CardNotFoundException();

        return $card;
    }
    
    public function create(array $data): Card 
    {
        $exists = $this->repository->exists($data['title'], $data['description']);
        if ($exists)
            throw new CardAlreadyCreated();

        $card = $this->repository->create($data);

        return $card;
    }

    public function update(array $data): Card
    {
        $card = $this->repository->getById($data['id']);
        
        $this->repository->update($card, $data);
    
        return $card;
    }

    public function delete(int $id)
    {
        $card = $this->repository->getById($id);

        if ($card === null)
            throw new CardNotFoundException();

        return $this->repository->delete($card);
    }
}