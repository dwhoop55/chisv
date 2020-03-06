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
            'destinations.*.state_id' => "exists:states,id",
            'destinations.*.email' => "required_if:type,email|email:rfc,dns",

            'elements' => "required|array|filled",
            'elements.*.type' => "required|in:action,markdown",
            'elements.*.data.caption' => "required_if:type,action|string",
            'elements.*.data.url' => "required_if:type,action|url",
            'subject' => "string|nullable",
            'greeting' => "string|nullable",
            'salutation' => "string|nullable",
        ];
    }

    public function messages()
    {
        return [
            "destinations.required" => "You need to add at least one destination",
            "destinations.array" => "Destinations has to be an array",
            "destinations.filled" => "Destinations has to be a filled array",
            "destinations.*.type" => "An destination object requires a known type",
            "destinations.*.user_id" => "An user destination object requires a known user_id",
            "destinations.*.role_id" => "An group destination object requires a known role_id",
            "destinations.*.state_id*" => "If a group destination object has a state_id it has to be valid (db)",
            "destinations.*.email" => "An email destination object requires a valid address",
            "elements.required" => "You need to add at least one element",
            "elements.array" => "Elements has to be an array",
            "elements.filled" => "Elements has to be a filled array",
            "elements.*.type.*" => "An element object requires a known type",
            "elements.*.data.caption*" => "An action element object requires a caption",
            "elements.*.data.url*" => "An action element object requires a valid url",
            "subject.*" => "Please set a subject for mailing",
        ];
    }
}