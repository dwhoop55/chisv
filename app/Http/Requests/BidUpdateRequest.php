<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BidUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'preference' => 'required|between:0,3',
        ];
    }
}
