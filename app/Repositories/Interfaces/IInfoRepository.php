<?php

namespace App\Repositories\Interfaces;

use App\Models\Info;
use Illuminate\Support\Collection;

interface IInfoRepository
{
    public function getAll(): Collection;
    public function getById(int $id): ?Info;
    public function getByCardId(int $card_id): Collection;
    public function getByRenterId(int $renter_id): Collection;
    public function create(array $data): Info;
    public function update(Info &$info, array $data): bool;
    public function delete(Info $info): ?bool;
}