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
        'firstname', 'lastname', 'email', 'password', 'city_id', 'shirt_id', 'degree_id', 'university_id'
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

    public function languages()
    {
        return $this->belongsToMany('App\Language');
    }

    public function degree()
    {
        return $this->belongsTo('App\Degree');
    }

    public function shirt()
    {
        return $this->belongsTo('App\Shirt');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function university()
    {
        // TODO: add fallback case for no id attached
        return $this->belongsTo('App\University');
    }


    public function permissions()
    {
        return $this->hasMany('App\Permission');
    }

    public function grant(Role $role, Conference $conference, State $state = null)
    {
        $permission = new Permission;
        $permission->user()->associate($this);
        $permission->role()->associate($role);
        $permission->conference()->associate($conference);
        $permission->state()->associate($state);
        return $permission->save();
    }

    // public function grant(Role $role, Conference $scope)
    // {
    //     $state = null;
    //     if ($role == Role::byName('sv')) {
    //         // Assigned role is sv, so we need to set state to enrolled
    //         $state = State::byName('enrolled');
    //     }
    //     try {
    //         $this->roles()->attach($role->id, ['conference_id' => $scope->id, 'state_id' => $state->id]);
    //         return true;
    //     } catch (\Throwable $th) {
    //         return false;
    //     }
    // }

    // public function revoke(Role $role, Conference $scope)
    // {
    //     $matchingScopedRoles = $this->roles()->where('id', $role->id)->where('conference_id', $scope->id);
    //     if ($matchingScopedRoles->count() > 0) {
    //         try {
    //             return ($this->roles()->detach($role->id, ['conference_id' => $scope->id]) > 0) ? true : false;
    //         } catch (\Throwable $th) {
    //             return false;
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    // public function can(Role $role, Conference $scope)
    // {
    //     return $this->roles->where('id', $role->id)->where('conference_id', $scope->id);
    // }

    //     /**
    //      *  Conference Admin Section 
    //      */

    //     public function isAdminForConferences()
    //     {
    //         return $this->belongsToMany('App\Conference', 'conference_admin');
    //     }

    //     public function isAdminForConference(Conference $conference)
    //     {
    //         return $this->isAdminForConferences->contains($conference);
    //     }

    //     public function addAsAdminForConference(Conference $conference)
    //     {
    //         try {
    //             $this->isAdminForConferences()->attach($conference->id);
    //             return true;
    //         } catch (\Throwable $th) {
    //             return false;
    //         }
    //     }

    //     public function removeAsAdminForConference(Conference $conference)
    //     {
    //         try {
    //             return $this->isAdminForConferences()->detach($conference->id);
    //         } catch (\Throwable $th) {
    //             return false;
    //         }
    //     }


    //     /**
    //      *  Student Volunteer Section 
    //      */

    //     public function isSvForConferences()
    //     {
    //         return $this->belongsToMany('App\Conference', 'conference_sv');
    //     }

    //     public function isSvForConference(Conference $conference)
    //     {
    //         return $this->isSvForConferences->contains($conference);
    //     }

    //     public function addAsSvForConference(Conference $conference)
    //     {
    //         try {
    //             $this->isSvForConferences()->attach($conference->id);
    //             return true;
    //         } catch (\Throwable $th) {
    //             return false;
    //         }
    //     }

    //     public function removeAsSvForConference(Conference $conference)
    //     {
    //         try {
    //             return $this->isSvForConferences()->detach($conference->id);
    //         } catch (\Throwable $th) {
    //             return false;
    //         }
    //     }
}