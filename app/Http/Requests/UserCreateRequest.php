<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\User;

class UserCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users,email',

            'languages' => ['required'],

            'location' => ['required'],
            'location.city.id' => ['required', 'exists:cities,id'],

            'university' => ['required'],
            'university.name' => ['required', 'string'],

            'degree_id' => ['required', 'integer', 'exists:degrees,id'],
            'shirt_id' => ['required', 'integer', 'exists:shirts,id'],
            'past_conferences' => ['nullable', 'string'],
            'past_conferences_sv' => ['nullable', 'string'],

            'password' => ['required', 'string', 'min:6', 'confirmed']
        ];

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'email address',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 'location.*' => 'Please choose the city closest to you',
            'languages.*' => 'You need to at least choose one language',
            'university.*' => 'Please pick your university. If it\'s not in the list, type its name',
            'degree_id.*' => 'Choosing a degree program is required',
            'shirt_id.*' => 'Choosing a shirt is required',
        ];
    }
}