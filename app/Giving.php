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
        'payment_status',
        'transaction_id',
        'slug'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Capitalise the first letter of the payment status attribute
     * @param $value
     */
    public function setPaymentStatus($value)
    {
        $this->attributes['payment_status'] = ucwords($value);
    }
}
