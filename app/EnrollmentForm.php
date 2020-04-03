<?php

namespace App;

use App\Services\EnrollmentFormService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class EnrollmentForm extends Model
{

    /** 
     * Ensure some attributes are casted correctly as int
     * They end up as string in the frontend which destroys sorting
     */
    protected $casts = [
        'total_weight' => 'integer',
        'parent_id' => 'integer',
        'is_template' => 'integer'
    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function permission()
    {
        return $this->hasOne('App\Permission');
    }

    public function user()
    {
        return $this->hasOneThrough('App\User', 'App\Permission', 'enrollment_form_id', 'id', 'id', 'user_id');
    }

    public function conferences()
    {
        return $this->hasMany('App\Conference');
    }

    public function parent()
    {
        return $this->belongsTo('App\EnrollmentForm', 'parent_id');
    }

    public function updateTotalWeight(array $weights = null)
    {
        $value = 0;

        if (!$weights) {
            // no special weights passed, so use the ones from the template
            $enrollmentFormService = new EnrollmentFormService();
            $weights = $enrollmentFormService->extractWeights($this->parent);
        }

        $fields = json_decode($this->body)->fields;

        if (!$weights || !$fields) {
            return null;
        }

        foreach ($fields as $key => $field) {
            if ($field->type == 'boolean' || $field->type == 'integer') {
                $value += $field->value * $weights[$key];
            }
        }

        $this->update(['total_weight' => $value]);

        return $value;
    }
}