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
        'name', 'email', 'password',
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
    ];

    /**
     * If the user is global system admin this will be true
     * 
     * @var boolean
     */
    public function isAdmin()
    {
        return $this->is_admin == true;
    }
    
    /**
     * If the user can add a new conference
     * 
     * @var boolean
     */
    public function canAddConference()
    {
        if ($this->isAdmin()) { // or map table lookup
            return true;
        } else {
            return false;
        }
    }

    /**
     * If the user can manage the provided conference
     * 
     * @var boolean
     */
    public function canManageConference(Conference $conference)
    {
        if ($this->isAdmin()) { // or map table lookup
            return true;
        } else {
            return false;
        }
    }
}
