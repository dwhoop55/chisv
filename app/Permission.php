<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    /** 
     * Ensure some attributes are casted correctly as int
     * They end up as string in the frontend which destroys sorting
     */
    protected $casts = [
        'lottery_position' => 'integer',
    ];

    protected $with = ['role', 'user', 'conference', 'state', 'enrollmentForm'];
    protected $hidden = ['role_id', 'user_id', 'conference_id', 'state_id', 'enrollment_form_id'];
    protected $guarded = [];

    // Add a computed property to the model
    public function toArray()
    {
        $array = parent::toArray();
        if ($this->state == State::byName('waitlisted')) {
            $array['waitlist_position'] = $this->getWaitlistPositionAttribute();
        }
        return $array;
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function conference()
    {
        return $this->belongsTo('App\Conference');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function enrollmentForm()
    {
        return $this->belongsTo('App\EnrollmentForm');
    }

    /**
     * Returns the position on the waitlist
     * Instead of only the position it also returns the
     * amount of SVs in front and behind the own
     * permission
     * @return Collection
     */
    public function getWaitlistPositionAttribute()
    {

        $pre = Permission::where('conference_id', $this->conference_id)
            ->where('role_id', Role::byName('sv')->id)
            ->where('state_id', State::byName('waitlisted')->id)
            ->where('lottery_position', '<', $this->lottery_position)
            ->count();

        $post = Permission::where('conference_id', $this->conference_id)
            ->where('role_id', Role::byName('sv')->id)
            ->where('state_id', State::byName('waitlisted')->id)
            ->where('lottery_position', '>', $this->lottery_position)
            ->count();

        $pos = $pre + 1;

        return collect(['pre' => $pre, 'post' => $post, 'position' => $pos]);
    }
}