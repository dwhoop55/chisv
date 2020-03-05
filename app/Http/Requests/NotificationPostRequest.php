<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationPostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'destinations' => "required|array|filled",
            'destinations.*.type' => "required|in:user,group,email",
            'destinations.*.user_id' => "required_if:type,user|exists:users,id",
            'destinations.*.group_id' => "required_if:type,group|exists:roles,id",
            'destinations.*.email' => "required_if:type,email|email:rfc,dns",

            'elements' => "required|array|filled",
            'subject' => "string|nullable",
            'greeting' => "string|nullable",
            'salutation' => "string|nullable",
        ];
    }

    public function messages()
    {
        return [
            "destinations" => "You need to add at least one destination",
            "destinations.*.type" => "An destination object requires a known type",
            "destinations.*.user_id" => "An user destination object requires a known user_id",
            "destinations.*.role_id" => "An group destination object requires a known role_id",
            "destinations.*.email" => "An email destination object requires a valid address",
            "elements.*" => "You need to add at least one element",
            "subject.*" => "Please set a subject for mailing",
        ];
    }
}