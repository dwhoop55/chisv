<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'exists:tasks,id',
            'conference_id' => 'integer|exists:conferences,id',
            'name' => 'string|max:255',
            'location' => 'string|nullable|max:255',
            'description' => 'string|nullable|max:1000',
            'date' => 'date',
            'start_at' => 'regex:/^\d{2}:\d{2}:\d{2}$/i',
            'end_at' => 'regex:/^\d{2}:\d{2}:\d{2}$/i',
            'hours' => 'numeric|min:0|max:23.99',
            'priority' => 'integer|min:1|max:3',
            'slots' => 'integer|min:1',
        ];
    }
}