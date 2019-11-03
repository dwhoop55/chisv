<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Conference;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ConferenceUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $conference = $request->route('conference');
        abort_unless($conference, 400, "No conference with this id!");

        $rules = [
            'name' => 'max:70|unique:conferences,name,' . $conference->id,
            'key' => 'max:30|alpha_num|unique:conferences,key,' . $conference->id,
            'location' => 'string|max:70',
            'timezone_id' => 'integer|exists:timezones,id',
            'start_date' => 'date',
            'end_date' => 'date',
            'description' => 'string|max:1000',
            'url_name' => 'nullable|string|max:100',
            'url' => 'nullable|string|max:300|url',
            // Make sure the selected enrollment form is existing
            // and a template
            'enrollment_form_id' => [
                'required',
                'integer',
                Rule::exists('enrollment_forms', 'id')->where(function ($query) {
                    $query->where('is_template', true);
                }),
            ],
            'state_id' => 'integer|exists:states,id',
            'volunteer_hours' => 'integer|min:0',
            'volunteer_max' => 'integer|min:0',
            'email_chair' => 'string|email',
            'enable_bidding' => 'boolean',
        ];

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "key.alpha_num" => "This has to be a valid part of an http url",
            "timezone_id.*" => "Please pick a timezone from the list",
            "location.*" => "Please specify a location",
            "description.string" => "Please give a short intro into the conference",
            "enrollment_form_id.*" => "Please select an enrollment form from the list"
        ];
    }
}