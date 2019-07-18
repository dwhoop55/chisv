<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Conference;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ConferenceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'name' => 'required|max:100|unique:conferences,name',
            'key' => 'required|max:30|unique:conferences,key',
            'icon' => 'file|image|mimes:jpeg,png,gif,webp|max:1024',
            'image' => 'file|image|mimes:jpeg,png,gif,webp|max:2048',
            'location' => 'required|max:100',
            'start_date' => 'date',
            'end_date' => 'date',
            'description' => 'max:350',
            'timezone_id' => 'integer|exists:timezones,id',
            'state_id' => 'integer|exists:states,id',
            'enable_bidding' => 'integer',
            'delete_icon' => 'integer',
        ];

        // Check if the request is a PUT (update) request
        // and append the laravel "except given id" for the name
        // and key.
        // See: https://laravel.com/docs/5.8/validation#rule-unique
        if ($request->method === "PUT") {
            $conference = Conference::find($request->id);
            $rules['name'] .= ',' . $conference->id;
            $rules['key'] .= ',' . $conference->id;
        } else {
            // It is a POST (create) request.
        }

        return $rules;
    }
}