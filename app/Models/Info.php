<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table = 'infos';

    protected $fillable = [
        'renter_id',
        'card_id',
        'payment_date',
        'payment_value'
    ];

    public function renter()
    {
        return $this->belongsTo(Renter::class, 'renter_id', 'id');
    }

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id', 'id');
    }
}
