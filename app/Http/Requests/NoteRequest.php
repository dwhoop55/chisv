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
            'for_id' => 'required|exclude_if:for_type,App\Assignment|exists:users,id',
            'for_id' => 'required|exclude_if:for_type,App\User|exists:assignments,id',
            'conference_id' => ['required_if:for_type,App\User|exists:conferences,id'],
            'for_type' => ['required', Rule::in(['App\User', 'App\Assignment'])],
            'text' => 'required|string',
        ];
    }
}