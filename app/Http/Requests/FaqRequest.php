<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => ["required", "string", "max:255"],
            "body" => ["required", "string"],
            "keywords" => ['required', 'array', 'notIn:[]'],
            'role_id' => ['required', 'integer', 'exists:roles,id']
        ];
    }
}