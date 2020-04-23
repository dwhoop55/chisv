<?php

namespace App\Services;

use App\EnrollmentForm;
use Faker\Generator;
use Illuminate\Http\Request;


class EnrollmentFormService
{
    /**
     * Will load the enrollmentForm from database
     * (based on the id in the body) and then fill
     * the form with the data params.
     * The filled form is then returned
     * @param Request $request Request from the user
     * @return EnrollmentForm The filled form
     */
    public function getFilledWith(Request $request)
    {
        $emptyForm = $this->getTemplateFor($request);
        $filledForm = $this->fill($emptyForm, $request);

        return $filledForm;
    }

    /**
     * This will create a new fake enrollment form
     * with random values. It is used for test seeding
     * @return EnrollmentForm A filled enrollmentForm
     */
    public function getFilledFake()
    {
        $randomForm = EnrollmentForm::where('is_template', 1)->first();
        $filledForm = new EnrollmentForm([
            'parent_id' => $randomForm->id,
            'name' => $randomForm->name,
            'body' => json_encode($this->fillBodyWithFake(json_decode($randomForm->body, true))),
            'is_template' => false,
        ]);

        return $this->removeWeights($filledForm);
    }
    /**
     * Extracts the weights from a form and returns them
     * @param EnrollmentForm form A template enrollmentForm with
     * weights in the fieldset
     * @return Collection
     */
    public function extractWeights(EnrollmentForm $form)
    {
        $weights = collect();
        $body = json_decode($form->body, true);

        foreach ($body['fields'] as $key => $field) {
            if (key_exists('weight', $field)) {
                $weights[$key] = $field['weight'];
            }
        }

        return $weights;
    }

    private function fillBodyWithFake($body)
    {
        $generator = new Generator;
        $misc = new \Faker\Provider\Miscellaneous($generator);
        $lorem = new \Faker\Provider\Lorem($generator);
        foreach ($body["fields"] as $key => $field) {
            switch ($field['type']) {
                case 'string':
                    $body['fields'][$key]['value'] = $lorem->paragraph();
                    break;
                case 'boolean':
                    $body['fields'][$key]['value'] = $misc->boolean();
                    break;
                case 'integer':
                    $body['fields'][$key]['value'] = $misc
                        ->numberBetween($body['fields'][$key]['range'][0], $body['fields'][$key]['range'][1]);
                    break;
                default:
                    break;
            }
        }
        return $body;
    }

    /** 
     * Will return a template EnrollmentForm
     * for the id in the request
     * @param Request $request An Illuminate request with the 'id' key set
     * @return EnrollmentForm An empty enrollmentForm fresh from the database
     */
    public function getTemplateFor(Request $request)
    {
        $data = $request->toArray();
        if (
            !isset($data['id'])
            || !$data['id']
        ) {
            abort(400, 'No id given!');
        }

        $formById = EnrollmentForm::findOrFail($data['id']);
        if (!$formById->is_template) {
            // The form is not an template but a filled form
            // get the template for it
            $template = EnrollmentForm::where('is_template', true)->findOrFail($formById->parent_id);
        } else {
            // The form is already an teamplate
            $template = $formById;
        }

        // Create a new form, because we only wanted to duplicate the body and fields
        // There should be no id or permission id connected to it - just a raw form
        $form = new EnrollmentForm([
            'parent_id' => $template->id,
            'name' => $template->name,
            'body' => $template->body,
            'is_template' => true
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

        // Form is now longer a template
        $form->is_template = false;

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