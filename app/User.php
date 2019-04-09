<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
     * The groups that belong to the user.
     */
    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

    /**
     * If the user is global system admin this will be true
     *
     * @var boolean
     */
    public function isAdmin()
    {
        return;
    }

    /**
     * If the user can add a new conference
     *
     * @var boolean
     */
    public function canAddConference()
    {
        return;
    }

    /**
     * If the user can manage the provided conference
     *
     * @var boolean
     */
    public function canManageConference(Conference $conference)
    {
        return;
    }
}