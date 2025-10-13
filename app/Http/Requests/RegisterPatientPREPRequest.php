<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPatientPREPRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Step 1: Personal Details
            'service_id' => 'nullable|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_initial' => 'required|string|max:2',
            'suffix' => 'nullable|string|max:4',
            'date_of_registration' => 'required|date',

            'region' => 'string|max:255',
            'province' => 'string|max:255',
            'city' => 'string|max:255',
            'barangay' => 'string|max:255',
            'description' => 'string|max:255',

            'contact_number' => 'required|string|max:13',
            'sex' => 'string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer|min:0',

            'temperature' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'blood_pressure' => 'nullable|string|max:255',

            // current vaccination details
            //active vaccine category
            'route_of_administration' => 'required|string|max:255',
            'active_vaccine_category' => 'required|in:PVRV,PCEC',
            'pvrv_vaccine_id' => 'nullable|integer',
            'pcec_vaccine_id' => 'nullable|integer',

            //previous rabies vaccination
            'immunization_type' => 'nullable|string|max:255',
            'date_dose_given' => 'nullable|date',
            'place_of_immunization' => 'nullable|string|max:255',



            //nurse
            'nurse_id' => 'required|integer',

            //step 5: payment
            'datetime_today' => 'required|date',
            'dateOfTransaction' => 'required|date',
            'service_id' => 'nullable|integer',
            'staff_id' => 'required|integer',
            'total_amount' => 'required|numeric|min:0',
        ];
    }
}
