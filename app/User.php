<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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

    public function conferencesAsChairOrCaptain()
    {
        return $this->conferencesByRole(Role::byName('chair'))
            ->merge($this->conferencesByRole(Role::byName('captain')));
    }

    public function conferencesByRole(Role $role)
    {
        return $this->hasManyThrough('App\Conference', 'App\Permission', 'user_id', 'id', 'id', 'conference_id')->where('role_id', $role->id)->get();
    }

    public function conferences()
    {
        return $this->hasManyThrough('App\Conference', 'App\Permission', 'user_id', 'id', 'id', 'conference_id');
    }

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

    public function timezone()
    {
        return $this->belongsTo('App\Timezone');
    }

    public function avatar()
    {
        return $this->morphOne('App\Image', 'owner')->orderBy('updated_at', 'DESC');
    }

    public function isAdmin()
    {
        return $this->hasPermission(Role::byName('admin'));
    }

    public function isChair(Conference $conference = null)
    {
        return $this->hasPermission(Role::byName('chair'), $conference);
    }

    public function isCaptain(Conference $conference = null)
    {
        return $this->hasPermission(Role::byName('captain'), $conference);
    }

    public function isSv(Conference $conference = null)
    {
        return $this->hasPermission(Role::byName('sv'), $conference);
    }

    public function grant(Role $role, Conference $conference, State $state = null, EnrollmentForm $enrollmentForm = null)
    {
        $permission = new Permission;
        $permission->user()->associate($this);
        $permission->role()->associate($role);
        $permission->conference()->associate($conference);
        $permission->state()->associate($state);

        try {
            $permission->save();

            // Now that we have the model id-ed in the database
            // we can save the enrollmentForm when available
            if ($enrollmentForm) {
                $permission->enrollmentForm()->save($enrollmentForm);
            }
            return $permission;
        } catch (QueryException $th) {
            return null;
        }
    }

    public function revoke(Role $role, Conference $conference)
    {
        // We can call first() here because the can only be one row
        // from the query, since we defined the columns to be unique
        $permission = $this->permissions
            ->where('role_id', $role->id)
            ->where('conference_id', $conference->id)
            ->first();

        if ($permission) {
            try {
                return $permission->delete();
            } catch (QueryException $th) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function hasPermission(Role $role, Conference $conference = null)
    {
        if ($conference) {
            return $this->permissions->where('role_id', $role->id)->where('conference_id', $conference->id)->isNotEmpty();
        } else {
            return $this->permissions->where('role_id', $role->id)->isNotEmpty();
        }
    }

    public function svStateFor(Conference $conference)
    {
        $permission = $this->permissions()
            ->where('conference_id', $conference->id)
            ->where('role_id', Role::byName('sv')->id)->first();

        return $permission ? $permission->state : null;
    }

    public function svPermissionFor(Conference $conference)
    {
        $permission = $this->permissions()
            ->where('conference_id', $conference->id)
            ->where('role_id', Role::byName('sv')->id)->first();

        return $permission ? $permission : null;
    }

    public function setSvStateFor(State $state, Conference $conference)
    {
        $permission = $this->permissions()
            ->where('conference_id', $conference->id)
            ->where('role_id', Role::byName('sv')->id)->first();

        if ($permission) {
            return $permission->update(['state_id' => $state->id]);
        } else {
            return false;
        }
    }

    public function toTimezone($date)
    {
        $timezone = $this->timezone;
        $carbonDate = new Carbon($date);
        $carbonDate->timezone = $timezone->name;
        return $carbonDate;
    }

    public function formatDate($date, $format = null)
    {
        if (!$format) {
            $format = $this->date_format . ' ' . $this->time_format;
        }
        return $this->toTimezone($date)->format($format);
    }
}