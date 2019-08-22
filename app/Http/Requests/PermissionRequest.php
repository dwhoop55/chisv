<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Role;

class PermissionRequest extends FormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  *
    //  * @return bool
    //  */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'role_id' => ['required', 'exists:roles,id'],
            // We need no conference if the role is admin
            'conference_id' => ['nullable', 'exists:conferences,id', 'required_unless:role_id,' . Role::byName('admin')->id],
            // We need a state if the role is sv
            'state_id' => ['nullable', 'exists:states,id', 'gte:10', 'required_if:role_id,' . Role::byName('sv')->id],
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => "You need to pick a role",
            'conference_id.required_unless' => "You need to pick a conference",
            'state_id.required_if' => 'You need to choose a state when granting SV permissions'
        ];
    }

    public function attributes()
    {
        return [
            'role_id' => 'role',
            'conference_id' => 'conference',
            'state_id' => 'state',
        ];
    }
}