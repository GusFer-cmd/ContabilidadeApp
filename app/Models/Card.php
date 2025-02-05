<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    protected $fillable = [
        'title',
        'description',
        'create_date'
    ];

    public function infoCard() 
    {
        return $this->hasOne(Info::class, 'card_id', 'id');
    }

}
