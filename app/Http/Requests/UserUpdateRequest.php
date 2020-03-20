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
            'firstname' => ['required_without:password'],
            'firstname' => ['string', 'max:255'],
            'lastname' => ['required_without:password'],
            'lastname' => ['string', 'max:255'],
            'email' => ['required_without:password'],
            'email' => 'string|email|max:255|unique:users,email,' . $request->id,

            'languages' => ['required_without:password', 'array', 'notIn:[]'],
            'languages.*.id' => ['required_with:languages', 'exists:languages,id'],

            'location' => ['required_without:password'],
            'location.country.id' => ['required_with:location', 'exists:countries,id'],
            'location.region.id' => ['required_with:location', 'exists:regions,id'],
            'location.city.id' => ['required_with:location', 'exists:cities,id'],

            'university.name' => ['required_with:university', 'string'],
            'university.id' => ['integer'],

            'degree_id' => ['integer', 'exists:degrees,id'],
            'shirt_id' => ['integer', 'exists:shirts,id'],

            'timezone_id' => ['integer', 'exists:timezones,id'],
            'locale_id' => ['integer', 'exists:locales,id'],


            'past_conferences' => ['nullable', 'string'],
            'past_conferences_sv' => ['nullable', 'string'],

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
            'location.*' => 'Please choose the city closest to you',
            'languages.*' => 'You need to at least choose one language',
            'university.*' => 'Please pick your university. If it\'s not in the list, type its name',
            'degree_id.*' => 'Choosing a degree program is required',
            'shirt_id.*' => 'Choosing a shirt is required',
        ];
    }
}