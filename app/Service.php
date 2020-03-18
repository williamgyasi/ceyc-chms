<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'pastorial_assistant',
        'service_admin'
    ];

    protected $casts = [
        'start_time'    => 'time',
        'end_time'      => 'time'
    ];

    /**
     * Defines the relation between the Service Model (services table)
     * and the Fellowship Model (fellowships table).
     * 
     * A Service may have one or more Fellowships attending it.
     */
    public function fellowships()
    {
        return $this->hasMany(Fellowship::class);
    }

    /**
     * This gets the name of the particular service and then
     * appends the word 'Service' to it.
     */
    public function getServiceNameAttribute()
    {
        return "{$this->name}  Service ";
    }

    /**
     * Defines the relationship between a Service Model (services table)
     * and the User Model (users table) specifically relating to a user 
     * with the role of a pastorial assistant.
     * 
     * A Service has only one pastorial assistant.
     */
    // public function pastorialAssistant()
    // {
    //     return $this->hasOne(User::class, 'pastorial_assistant');
    // }

    /**
     * Defines the relationship between a Service Model (services table)
     * and the User Model (users table) specifically relation to a user
     * with the role of a service administrator.
     * 
     * A Service has only one service administrator
     */
    // public function serviceAdministrator()
    // {
    //     return $this->hasOne(User::class, 'service_admin');
    // }
}
