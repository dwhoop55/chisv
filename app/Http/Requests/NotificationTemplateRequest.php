<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationTemplateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data.destinations' => "array",
            'data.destinations.*.type' => "required|in:group",
            'data.destinations.*.group_id' => "required_if:type,group|exists:roles,id",

            'data.elements' => "required|array|filled",
            'data.elements.*.type' => "required|in:action,markdown",
            'data.elements.*.data.caption' => "required_if:type,action|string",
            'data.elements.*.data.url' => "required_if:type,action|url",
            'data.subject' => "string|nullable",
            'data.greeting' => "string|nullable",
            'data.salutation' => "string|nullable",

            'name' => 'required|string',
            'conference_id' => 'required|exists:conferences,id'
        ];
    }
}