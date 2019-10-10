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
        $form = $enrollmentFormService->getEmptyFor(request());
        $fields = json_decode($form->body, true)['fields'];

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

            // Make a laravel validation rule from it
            $rule = $rule->implode('|');

            // Assign it to the rules array
            $rules[$key] = $rule;
        }

        return $rules->toArray();
    }
}