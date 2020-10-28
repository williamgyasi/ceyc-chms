<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'lastname',
        'firstname',
        'phone',
        'default_password_reset_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob'               =>  'date'
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
     * Defines a relationship between users and their roles
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)

                    ->withTimestamps();
    }

    /**
     * Checks if the current user has the particular role
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }

        return false;
    }

}
