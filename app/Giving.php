<?php

namespace App;

use Carbon\Carbon;
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

    protected $casts = [
        'created_at' => 'date'
    ];

    /**
     * Capitalise the first letter of the payment status attribute
     * @param $value
     */
    public function setPaymentStatus($value)
    {
        $this->attributes['payment_status'] = ucfirst($value);
    }

    public function getPaymentStatusAttribute($value)
    {
        return ucfirst($value);
    }

    public static function scopeMadeOnCurrentDay($query)
    {
        $query->whereDate('created_at', Carbon::today());
    }

    /**
     * Method to get all approved givings for the current day.
     */
    public static function scopeApprovedGivings($query)
    {
        return $query->whereDate('created_at', Carbon::today())
                    ->wherePaymentStatus('Approved');
    }

    /**
     * Method to get all declined givings for the current day.
     */
    public static function scopeDeclinedGivings($query)
    {
        return $query->whereDate('created_at', Carbon::today())
                    ->wherePaymentStatus('Declined');
    }

    /**
     * Method to get all failed givings for the current day.
     * NB: both givings with a payment status of either error or null
     * are regarded as failed givings
     */
    public static function scopeFailedGivings($query)
    {
        return $query->whereDate('created_at', Carbon::today())
                    ->where(function($query) {
                        $query->wherePaymentStatus('Failed')
                        ->orWhere('payment_status', 'error')
                        ->orWhere('payment_status', 'access denied')
                        ->orWhereNull('payment_status');
                    });
    }

    /**
     * Method to filter givings
     *
     * @param [type] $query
     * @param array $filters
     * @return void
     */
    public function scopeFilter($query, array $filters)
    {
        if ($filters['status']) {
            $query->wherePaymentStatus($filters['status']);
        }

        if ($filters['start_date'] && $filters['end_date']) {
            $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
        }

        if ($filters['reference']) {
            $query->whereGivingOption($filters['reference']);
        }
    }
}
