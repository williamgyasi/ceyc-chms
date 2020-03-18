<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'leader'
    ];

    /**
     * This function Capitalises every word of the name
     * of the Department. for example, if the user should enter 'department one',
     * the function will set the name of the fellowship to 'Department One' before 
     * saving to the DB
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    /**
     * A Department has many members. This function describes
     * the relationship between a department and members
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
