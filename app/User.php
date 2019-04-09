<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
     *  Group Management
     */

    /**
     * The groups that belong to the user.
     */
    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

    public function addToGroup(Group $group)
    {
        try {
            $this->groups()->attach($group->id);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function removeFromGroup(Group $group)
    {
        try {
            return ($this->groups()->detach($group->id) > 0) ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     *  Conference Admin Section 
     */

    public function isAdminForConferences()
    {
        return $this->belongsToMany('App\Conference', 'conference_admin');
    }

    public function isAdminForConference(Conference $conference)
    {
        return $this->isAdminForConferences->contains($conference);
    }

    public function addAsAdminForConference(Conference $conference)
    {
        try {
            $this->isAdminForConferences()->attach($conference->id);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function removeAsAdminForConference(Conference $conference)
    {
        try {
            return $this->isAdminForConferences()->detach($conference->id);
        } catch (\Throwable $th) {
            return false;
        }
    }


    /**
     *  Student Volunteer Section 
     */

    public function isSvForConferences()
    {
        return $this->belongsToMany('App\Conference', 'conference_sv');
    }

    public function isSvForConference(Conference $conference)
    {
        return $this->isSvForConferences->contains($conference);
    }

    public function addAsSvForConference(Conference $conference)
    {
        try {
            $this->isSvForConferences()->attach($conference->id);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function removeAsSvForConference(Conference $conference)
    {
        try {
            return $this->isSvForConferences()->detach($conference->id);
        } catch (\Throwable $th) {
            return false;
        }
    }
}
