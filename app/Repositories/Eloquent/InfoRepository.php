<?php

namespace App\Repositories\Eloquent;

use App\Models\Info;
use App\Repositories\Interfaces\IInfoRepository;
use Illuminate\Support\Collection;

class InfoRepository implements IInfoRepository
{
    public function getAll(): Collection
    {
        return Info::with('renter')->get();
    }
    
    public function getById(int $id): ?Info
    {
        return Info::with('card')->find($id);
    }

    public function getByCardId(int $card_id): Collection
    {
        return Info::where('card_id', $card_id)->get();
    }

    public function getByRenterId(int $renter_id): Collection
    {
        return Info::where('renter_id', $renter_id)->get();
    }

    public function create(array $data): Info
    {
        return Info::create($data);
    }

    public function update(Info &$info, array $data): bool
    {
        return $info->update($data);
    }

    public function delete(Info $info): ?bool
    {
        return $info->delete();
    }
}