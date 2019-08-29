<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'know_city' => 'required|boolean',
            'attend_before' => 'required|boolean',
            'sved_before' => 'required|boolean',
            'need_visa' => 'required|boolean',
            'why' => 'present|nullable|string|max:2000',
        ];
    }

    public function attributes()
    {
        return [
            'why' => "'Explain why you want to be an SV'"
        ];
    }
}