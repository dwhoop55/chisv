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
        'user_id' => 'integer',
        'conference_id' => 'integer',
        'enrollment_form_id' => 'integer',
    ];

    protected $with = [];
    protected $hidden = ['role_id', 'state_id', 'created_at', 'updated_at'];
    protected $guarded = [];

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
    public function updateWaitlistPosition()
    {
        if (!$this->lottery_position) return;

        $conferenceId = $this->conference_id;
        $allOthers = Permission
            ::where('conference_id', $conferenceId)
            ->where('user_id', '!=', $this->user_id)
            ->where('role_id', Role::byName('sv')->id)
            ->where('state_id', State::byName('waitlisted')->id)
            ->get('lottery_position');

        $pre = $allOthers->where('lottery_position', '<', $this->lottery_position)->count();
        $post = $allOthers->where('lottery_position', '>', $this->lottery_position)->count();

        $pos = $pre + 1;

        $this['waitlist_position'] = collect(['pre' => $pre, 'post' => $post, 'position' => $pos]);
        return $this['waitlist_position'];
    }
}