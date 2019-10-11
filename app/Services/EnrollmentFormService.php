<?php

namespace App\Services;

use App\EnrollmentForm;
use App\Http\Requests\EnrollRequest;
use Illuminate\Http\Request;

class EnrollmentFormService
{
    /**
     * Will load the enrollmentForm from database
     * (based in the id in the body) and then fill
     * the form with the data params.
     * The filled form is the returned
     * @param Request $request Request from the user
     * @return EnrollmentForm The filled form
     */
    public function getFilledWith(Request $request)
    {
        $emptyForm = $this->getEmptyFor($request);
        $filledForm = $this->fill($emptyForm, $request);

        return $filledForm;
    }

    /** 
     * Will return an unfilled EnrollmentForm
     * for the id in the request
     * @param Request $request An Illuminate request with the 'id' key set
     * @return EnrollmentForm An empty enrollmentForm fresh from the database
     */
    public function getEmptyFor(Request $request)
    {
        $data = $request->toArray();
        if (!$data['id']) {
            abort(400, 'No id given!');
        }
        // Load the form from the database
        $template = EnrollmentForm::findOrFail($data['id'])->where('is_filled', false)->first();

        // Create a new form, because we only wanted to duplicate the body and fields
        // There should be no id or permission id connected to it - just a raw form
        $form = new EnrollmentForm([
            'name' => $template->name,
            'body' => $template->body,
            'is_filled' => false
        ]);

        return $form;
    }

    /** Fill the empty form with the data from the request
     * @param EnrollmentForm $form An empty EnrollmentForm
     * @param Request $request The request with data for the form
     * @return EnrollmentForm The input form filled with the request body
     */
    private function fill(EnrollmentForm $form, Request $request)
    {
        // Extract the fields from the template
        $body = json_decode($form->body, true);
        $fields = $body['fields'];

        foreach ($request->toArray() as $key => $value) {
            // Skip id because the id will be different for a new form
            if ($key == 'id') continue;

            // Set the value into the form->body->field->{name} value
            $fields[$key]['value'] = $value;
        }

        // No reconstruct the complete form again with the fields
        // that we have just created - basically reverse the first
        // two lines
        $body['fields'] = $fields;
        $form->body = json_encode($body);

        // Form is now filled, so mark it
        $form->is_filled = true;

        return $form;
    }

    /**
     * Removes the weights from within the body->fields
     * and returns a version where only these weights are
     * missing
     * @param EnrollmentForm $form An enrollmentForm with field carrying weights
     * @return EnrollmentForm An enrollmentForm which has the weights removed
     */
    public function removeWeights(EnrollmentForm $form)
    {
        $body = json_decode($form->body, true);
        $fields = $body['fields'];

        foreach ($fields as $key => $value) {
            if (key_exists('weight', $fields[$key])) {
                unset($fields[$key]['weight']);
            }
        }

        $body['fields'] = $fields;
        $form->body = json_encode($body);

        return $form;
    }
}