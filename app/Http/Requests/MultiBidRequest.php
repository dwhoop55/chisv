<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MultiBidRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "conference_id" => "required|exists:conferences,id",
            "days" => "array|notIn:[]",
            'preference' => 'nullable|between:0,3',
            "search" => "string|nullable",
            "priorities" => "array|notIn:[]",
            "interval" => "array|notIn:[]"
        ];
    }
}