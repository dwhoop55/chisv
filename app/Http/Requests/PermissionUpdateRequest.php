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
            'state_id' => [
                'exists:states,id',
                'gte:10',
                'lt:20',
            ]
        ];
    }

    public function messages()
    {
        return [
            'state_id.*' => 'Invalid state id',
        ];
    }
}