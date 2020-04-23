<?php

namespace App\Http\Controllers;

use App\EnrollmentForm;
use App\Http\Requests\EnrollRequest;
use App\Services\EnrollmentFormService;
use Illuminate\Http\Request;

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
     * Displays a listing of template forms.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTemplates()
    {
        return EnrollmentForm::where('is_template', true)->get();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\EnrollmentForm  $enrollmentForm
     * @return \Illuminate\Http\Response
     */
    public function show(EnrollmentForm $enrollmentForm)
    {
        return $enrollmentForm;
    }

    /**
     * Update the specified resource in storage.
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