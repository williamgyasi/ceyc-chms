<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giving extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'contact',
        'amount',
        'giving_option',
        'transaction_id',
        'slug'
    ];

    public function getRouteKeyname()
    {
        return 'slug';
    }
}
