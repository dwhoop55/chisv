<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'conference_id' => 'required|integer|exists:conferences,id',
            'location' => 'string|nullable|max:255',
            'description' => 'string|nullable|max:1000',
            'date' => 'required|date',
            'start_at' => 'required|regex:/^\d{2}:\d{2}:\d{2}$/i',
            'end_at' => 'required|regex:/^\d{2}:\d{2}:\d{2}$/i',
            'hours' => 'required|numeric|min:0|max:23.99',
            'priority' => 'required|integer|min:1|max:3',
            'slots' => 'required|integer|min:1',
        ];
    }
}