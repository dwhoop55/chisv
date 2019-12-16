<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'   => "required_with:task_id|integer|exists:users,id",
            'task_id'   => "required_with:user_id|integer|exists:tasks,id",
            'hours'     => "between:0,23.99",
            'state_id'  => "exists:states,id"
        ];
    }
}