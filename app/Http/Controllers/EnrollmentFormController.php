<?php

namespace App\Http\Controllers;

use App\EnrollmentForm;
use App\Http\Requests\EnrollRequest;
use App\Services\EnrollmentFormService;
use Illuminate\Http\Request;

/**
 * @authenticated
 * @group Enrollment Form
 */
class EnrollmentFormController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(EnrollmentForm::class);
    }

    /**
     * Get all enrollment form templates
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTemplates()
    {
        return EnrollmentForm::where('is_template', true)->get();
    }


    /**
     * Get an enrollment form
     * 
     * @urlParam enrollment_form required The enrollment form's id Example: 1
     *
     * @param  \App\EnrollmentForm  $enrollmentForm
     * @return \Illuminate\Http\Response
     */
    public function show(EnrollmentForm $enrollmentForm)
    {
        return $enrollmentForm;
    }

    /**
     * Update an enrollment form
     * 
     * Use a dictionary of field names as keys value pairs.
     * Use the field names from the currently active enrollment form. The
     * fields below are just examples.
     * 
     * @urlParam enrollment_form required The enrollment form's id Example: 14
     * @bodyParam id int required The forms id Example: 14
     * @bodyParam attended_before int An example field Example: 5
     * @bodyParam know_city int An example field Example: true
     * @bodyParam need_visa int An example field Example: false
     * @bodyParam sved_before int An example field Example: 2
     * @bodyParam why_you_want_to_be_sv string An example field Example: Like the cake
     * 
     * response 200 {
     * "result": true,"message": "Form was updated!"
     * }
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EnrollmentForm  $enrollmentForm
     * @return \Illuminate\Http\Response
     */
    public function update(EnrollRequest $request, EnrollmentForm $enrollmentForm)
    {
        $service = new EnrollmentFormService;
        $form = $service->getFilledWith($request);
        $result = $enrollmentForm->update($form->only(['body']));

        if ($result) {
            return ["result" => true, "message" => "Form was updated!"];
        } else {
            return ["result" => false, "message" => "Form could not be updated"];
        }
    }
}
