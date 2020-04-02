<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\User;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'firstname' => ['string', 'max:255'],
            'lastname' => ['string', 'max:255'],
            'email' => 'string|email|max:255|unique:users,email,' . $this->route('user')->id,

            'languages' => ['array', 'notIn:[]'],
            'languages.*.id' => ['required_with:languages', 'exists:languages,id'],

            'location.country.id' => ['required_with:location', 'exists:countries,id'],
            'location.region.id' => ['nullable', 'exists:regions,id'],
            'location.city.id' => ['nullable', 'exists:cities,id'],

            'university.name' => ['required_with:university', 'string'],
            'university.id' => ['integer'],

            'degree_id' => ['integer', 'exists:degrees,id'],
            'shirt_id' => ['integer', 'exists:shirts,id'],

            'timezone_id' => ['integer', 'exists:timezones,id'],
            'locale_id' => ['integer', 'exists:locales,id'],


            'past_conferences' => ['nullable', 'array'],
            'past_conferences_sv' => ['nullable', 'array'],

            'password' => ['string', 'min:6', 'confirmed']
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
            'location.*' => 'Please pick your home country',
            'languages.*' => 'You need to at least choose one language',
            'university.*' => 'Please pick your university. If it\'s not in the list, type its name',
            'degree_id.*' => 'Choosing a degree program is required',
            'shirt_id.*' => 'Choosing a shirt is required',
        ];
    }
}