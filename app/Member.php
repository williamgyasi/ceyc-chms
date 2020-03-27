<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'fellowship_id',
        'department_id',
        'lastname',
        'firstname',
        'othernames',
        'phone',
        'alt_phone',
        'email',
        'dob',
        'residential_address',
        'digital_address',
        'school',
        'work',
        'gender'
    ];

    protected $casts = [
        'dob'   =>  'date'
    ];

    /**
     *  This Capitalises the first letter of the value of the firstname
     *  attribute before saving to the database
     */
    public function setFrstNameAttribute($value)
    {
        $this->attributes['firstname'] = ucwords($value);
    }

     /**
     *  This Capitalises the first letter of the value of the lastname
     *  attribute before saving to the database
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['lastname'] = ucwords($value);
    }

     /**
     *  This Capitalises the first letter of the value of the othernames
     *  attribute before saving to the database
     */
    public function setOtherNamesAttribute($value)
    {
        $this->attributes['othernames'] = ucwords($value);
    }

    /**
     * This gets both first and last names and concatenates them
     *  to form the fullname attribute
     */
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    /**
     * Relationship between the Members and a Fellowship.
     *
     * A member belongs to only one Fellowship
     */
    public function fellowship()
    {
        return $this->belongsTo(Fellowship::class);
    }

    /**
     * Relationship between the Department and
     * Members.
     *
     * A member belongs to a department
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Relationship Between Cells and Members
     */
    public function  cell()
    {
        return $this->belongsTo(Cell::class);
    }
}
