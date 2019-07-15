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
        $conference = Conference::find($request->id);
        return [
            'name' => 'required|max:100|unique:conferences,name,' . $conference->id,
            'key' => 'required|max:30|unique:conferences,key,' . $conference->id,
            'location' => 'required|max:100',
            'start_date' => 'date',
            'end_date' => 'date',
            'description' => 'max:350',
            'timezone_id' => 'integer|exists:timezones',
            'state_id' => 'integer|exists:states',
        ];
    }
}