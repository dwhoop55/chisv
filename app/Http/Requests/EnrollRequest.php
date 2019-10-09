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

        $rules = [];
        // We get our service provider to load the associated enrollment
        // form. Based on that form we generate to rules
        $enrollmentFormService = app('App\Services\EnrollmentFormService');
        $form = $enrollmentFormService->getTemplate(request());
        $fields = json_decode($form, true)['fields'];

        foreach ($fields as $key => $value) {
            if ($value['required']) { }
        }
        // return [
        //     'know_city' => 'required|boolean',
        //     'attended_before' => 'required|boolean',
        //     'sved_before' => 'required|boolean',
        //     'need_visa' => 'required|boolean',
        //     'why' => 'present|nullable|string|max:2000',
        // ];
    }

    // public function attributes()
    // {
    //     return [
    //         'why' => "'Explain why you want to be an SV'"
    //     ];
    // }

    public function validate(Request $request)
    {
        dd($request);
    }
}