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
        $conference = Conference::find($request->id);
        abort_unless($conference, 400, "No conference with this id!");

        $rules = [
            'name' => 'max:100|unique:conferences,name,' . $conference->id,
            'key' => 'max:30|url|unique:conferences,key,' . $conference->id,
            'icon' => 'file|image|mimes:jpeg,png,gif,webp|max:1024',
            'image' => 'file|image|mimes:jpeg,png,gif,webp|max:2048',
            'location' => 'string|max:100',
            'start_date' => 'date',
            'end_date' => 'date',
            'description' => 'string|max:1000',
            'timezone_id' => 'integer|exists:timezones,id',
            'state_id' => 'integer|exists:states,id',
            'enable_bidding' => 'integer',
            // 'delete_icon' => 'integer',
            // 'delete_image' => 'integer',
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
            "key.url" => "This has to be a valid part of an http url"
        ];
    }
}