<?php

namespace App\Repositories\Eloquent;

use App\Models\Card;
use App\Repositories\Interfaces\ICardRepository;
use Illuminate\Support\Collection;

class CardRepository implements ICardRepository
{
    public function getAll(): Collection
    {
        return Card::all();
    }
    
    public function getById(int $id): ?Card
    {
        return Card::find($id);
    }

    public function exists(string $title, string $description)
    {
        return Card::where('title', $title)
            ->where('description', $description)
            ->exists();
    }

    public function create(array $data): Card
    {
        return Card::create($data);
    }

    public function update(Card &$card, array $data): bool
    {
        return $card->update($data);
    }

    public function delete(Card $card): ?bool
    {
        return $card->delete();
    }
}