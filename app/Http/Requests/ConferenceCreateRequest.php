<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ConferenceCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:100|unique:conferences,name',
            'key' => 'required|alpha_num|max:30|unique:conferences,key',
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
            "key.alpha_num" => "This has to be a valid part of an http url. No whitespaces, only plain old ASCII.",
        ];
    }
}