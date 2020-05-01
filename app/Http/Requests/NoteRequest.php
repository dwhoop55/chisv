<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NoteRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'for_id' => 'required|exclude_unless:for_type,App\User|exists:users,id',
            // 'for_id' => 'required|exclude_unless:for_type,App\Assignment|exists:assignments,id',
            'for_type' => ['required', Rule::in(['App\User', 'App\Assignment'])],
            'text' => 'required|string',
        ];
    }
}