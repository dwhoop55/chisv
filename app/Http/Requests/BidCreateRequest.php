<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BidCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'task_id' => 'required|exists:tasks,id',
            'preference' => 'required|between:0,3',
        ];
    }
}