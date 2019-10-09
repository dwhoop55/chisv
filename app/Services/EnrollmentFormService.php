<?php

namespace App\Services;

use App\EnrollmentForm;
use Illuminate\Http\Request;

class EnrollmentFormService
{
    /**
     * Will load the enrollmentForm from database
     * (based in the id in the body) and then fill
     * the form with the data params.
     * The filled form is the returned
     * @param String form fields as array
     * @return EnrollmentForm the filled form
     */
    public function getFilled(Request $request)
    {

        $form = getFormForRequest($request);
        dd($form);
        // Extract the fields from the template
        $fields = json_decode($form->body, true)['fields'];



        return $form;
    }

    public function validate(Request $request)
    {
        $rules = [];
    }

    public function getTemplate(Request $request)
    {
        $data = $request->toArray();
        if (!$data['id']) {
            abort(400, 'No id given!');
        }
        // Load the form from the database
        $form = EnrollmentForm::findOrFail($data['id'])->where('is_filled', false)->first();

        return $form;
    }
}