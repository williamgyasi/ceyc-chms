<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'mobile_network',
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
