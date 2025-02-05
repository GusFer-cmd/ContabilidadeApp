<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    protected $table = 'renters';

    protected $fillable = [
        'name',
        'assigned_sex',
        'telephone',
        'email'
    ];

    public function renter()
    {
        return $this->hasMany(Renter::class, 'renter_id', 'id');
    }

    public function card()
    {
        return $this->hasMany(Card::class, 'card_id', 'id');
    }
}
