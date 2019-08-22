<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Conference;
use Illuminate\Http\Request;

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
            'description' => 'string|max:700',
            'state_id' => 'integer|exists:states,id',
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
            "description.string" => "Please give a short intro into the conference"
        ];
    }
}