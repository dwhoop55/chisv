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

            'languages' => ['required', 'array', 'notIn:[]'],
            'languages.*.id' => ['required_with:languages', 'exists:languages,id'],

            'location' => ['required'],
            'location.country.id' => ['required_with:location', 'exists:countries,id'],
            'location.region.id' => ['nullable', 'exists:regions,id'],
            'location.city.id' => ['nullable', 'exists:cities,id'],

            'university' => ['required'],
            'university.name' => ['required', 'string'],
            'university.id' => ['integer'],

            'degree_id' => ['required', 'integer', 'exists:degrees,id'],
            'shirt_id' => ['required', 'integer', 'exists:shirts,id'],

            'locale_id' => ['required', 'integer', 'exists:locales,id'],

            'past_conferences' => ['nullable', 'array'],
            'past_conferences_sv' => ['nullable', 'array'],

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
            'firstname.*' => 'Please type your first name',
            'lastname.*' => 'Please type your last name',
            'email.unique' => 'This address is taken. Do you already have an account?',
            'languages.*' => 'You need to at least choose one language',
            'location.*' => 'Please pick your home country',
            'location.country.id' => 'Please choose a country from the list',
            'university.*' => 'Please pick your university. If it\'s not in the list, type its name',
            'timezone.*' => 'Please pick your display timezone. Date and time will be adapted to the chosen timezone.',
            'degree_id.*' => 'Choose your current degree program.',
            'shirt_id.*' => 'You will need to pick a shirt that you will later wear.',
        ];
    }
}