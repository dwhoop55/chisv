<?php

namespace App\Http\Requests;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;

class PermissionUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => [
                'required',
                'exists:permissions,id',
            ],
            'state_id' => [
                'nullable',
                'required_if:role_id,' . Role::byName('sv'),
                'exists:states,id',
                'gte:10',
                'lt:20',
            ]
        ];
    }

    public function messages()
    {
        return [
            'id.required' => "You need to specify which permission",
            'state_id.*' => 'Invalid state id',
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'user',
            'state_id' => 'state',
        ];
    }
}