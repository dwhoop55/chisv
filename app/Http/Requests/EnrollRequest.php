<?php

namespace App\Http\Requests;

use App\Services\EnrollmentFormService;
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

        $rules = collect();
        // We get our enrollmentFormService which will return
        // to us an empty enrollmentForm for which the
        // request has the id set
        // Based on these fields we build the rules array
        $enrollmentFormService = new EnrollmentFormService();
        $form = $enrollmentFormService->getTemplateFor(request());
        $fields = json_decode($form->body, true)['fields'];

        // Make sure we reference an existing enrollment form (id will later
        // be the parent_id)
        $rules['id'] = "required|exists:enrollment_forms";

        foreach ($fields as $key => $value) {
            $rule = collect();
            if (array_key_exists('type', $value)) {
                $rule->push($value['type']);
            }
            if (array_key_exists('required', $value) && $value['required'] == true) {
                $rule->push('required');
            } else {
                $rule->push('nullable');
            }
            if (array_key_exists('maxlength', $value) && $value['maxlength'] > 0) {
                $rule->push('max:' . $value['maxlength']);
            }
            if (array_key_exists('range', $value) && isset($value['range'][0]) && isset($value['range'][1])) {
                $rule->push('between:' . $value['range'][0] . ',' . $value['range'][1]);
            }

            // Make a laravel validation rule from it
            $rule = $rule->implode('|');

            // Assign it to the rules array
            $rules[$key] = $rule;
        }

        return $rules->toArray();
    }

    public function messages()
    {
        // This code is very similiar to the rules() code above.
        // Chek for reference
        $messages = collect();
        $enrollmentFormService = new EnrollmentFormService();
        $form = $enrollmentFormService->getTemplateFor(request());
        $fields = json_decode($form->body, true)['fields'];

        // Make sure we reference an existing enrollment form (id will later
        // be the parent_id)
        $messages = collect([
            'id.required' => "The parent template must be specified via 'id'",
            'id.exists' => "The parent template does not exist",
        ]);

        foreach ($fields as $key => $value) {
            $niceKey = "'" . ucwords(str_replace('_', ' ', $key)) . "'";
            if (array_key_exists('type', $value) && $value['type'] == 'boolean') {
                $messages->put("$key." . $value['type'], "$niceKey has to be set");
            } else if (array_key_exists('type', $value) && $value['type'] == 'string') {
                $messages->put("$key." . $value['type'], "$niceKey has to have some text");
            } else if (array_key_exists('type', $value) && $value['type'] == 'integer') {
                $messages->put("$key." . $value['type'], "$niceKey has to hold a number");
            }

            if (array_key_exists('required', $value) && $value['required'] == true) {
                $messages->put("$key.required", "$niceKey has to be provided");
            }

            if (array_key_exists('maxlength', $value) && $value['maxlength'] > 0) {
                $messages->put("$key.max", "$niceKey is too much text. Reduce it");
            }
            if (array_key_exists('range', $value) && isset($value['range'][0]) && isset($value['range'][1])) {
                $messages->put("$key.min", "$niceKey is not enough. Provide at least " . $value['range'][0]);
                $messages->put("$key.max", "$niceKey is too much. Provide at most " . $value['range'][1]);
            }
        }

        return $messages->toArray();
    }
}