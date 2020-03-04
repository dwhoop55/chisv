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
            'elements' => "required|array|filled",
            'subject' => "string",
            'greeting' => "string"
        ];
    }

    public function messages()
    {
        return [
            "destinations.*" => "You need to add at least one destination",
            "elements.*" => "You need to add at least one element",
            "subject.*" => "Please set a subject for mailing",
            "greeting.*" => "Add a greeting"
        ];
    }
}