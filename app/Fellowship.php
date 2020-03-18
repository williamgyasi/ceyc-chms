<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fellowship extends Model
{
    protected $fillable = [
        'name',
        'leader'
    ];

    /**
     * This function Capitalises every word of the name
     * of the Fellowship. for example, if the user should enter 'fellowship one',
     * the function will set the name of the fellowship to 'Fellowship One' before 
     * saving to the DB
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    /**
     * A fellowship has Many Members. This function describes 
     * the relationship between a fellowship and it's members.
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
