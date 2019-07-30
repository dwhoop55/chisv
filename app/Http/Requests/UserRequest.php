<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'languages' => ['required', 'json'],
            'location' => ['required', 'json'],
            'university' => ['required', 'json'],

            'degree_id' => ['required', 'integer', 'exists:degrees,id'],
            'shirt_id' => ['required', 'integer', 'exists:shirts,id'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'past_conferences' => ['string'],
            'past_conferences_sv' => ['string'],
        ];

        // Check if the request is a PUT (update) request
        // and append the laravel "except given id" for the email
        // See: https://laravel.com/docs/5.8/validation#rule-unique
        if ($request->method === "PUT") {
            $user = User::find($request->id);
            $rules['email'] .= ',' . $user->email;
        } else {
            // It is a POST (create) request.
        }

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
            'location' => 'Choosing a city is required',
        ];
    }
}