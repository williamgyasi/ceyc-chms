<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    protected $fillable = [
        'name',
        'fellowship_id',
        'leader',
    ];

    /**
     * Relationship between a cell and fellowship.
     * A cell belongs to exactly one fellowship.
     */
    public function fellowship()
    {
        return $this->belongsTo(Fellowship::class);
    }

     /**
     * This function Capitalises every word of the name
     * of the Cell. for example, if the user should enter 'cell two'as the cell name,
     * the function will set the name of the fellowship to 'Cell' Two before 
     * saving to the DB
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
}