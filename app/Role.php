<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     *  This Capitalises the name attribute before saving to the database
     */
    public function setNameAttribute($value)
    {
        // $this->attributes['name'] = ucwords($value);
        $this->attributes['name'] = strtolower($value);
    }
    
}
