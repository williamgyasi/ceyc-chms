<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'name',
        'email',
        'amount',
        'payment_option'
    ];
}
