<?php

namespace App\Http\Controllers;

use App\EnrollmentForm;
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

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

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

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\EnrollmentForm  $enrollmentForm
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, EnrollmentForm $enrollmentForm)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\EnrollmentForm  $enrollmentForm
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(EnrollmentForm $enrollmentForm)
    // {
    //     //
    // }
}