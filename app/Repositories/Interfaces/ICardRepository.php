<?php

namespace App\Repositories\Interfaces;

use App\Models\Card;
use Illuminate\Support\Collection;

interface ICardRepository
{
    public function getAll(): Collection;
    public function getById(int $id): ?Card;
    public function exists(string $title, string $description);
    public function create(array $data): Card;
    public function update(Card &$card, array $data): bool;
    public function delete(Card $card): ?bool;
}