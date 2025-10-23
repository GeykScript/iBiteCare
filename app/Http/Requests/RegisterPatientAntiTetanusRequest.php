<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPatientAntiTetanusRequest extends FormRequest
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
            'service_id' => 'required|integer',
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
            'email' => 'nullable|string',

            'sex' => 'string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer|min:0',

            'temperature' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'blood_pressure' => 'nullable|string|max:255',

            'year_last_dose_given' => 'nullable|date_format:Y',
            'anti_tetanus_dose_given' => 'nullable|string|max:255',
            'anti_tetanus_vaccine_id' => 'nullable|integer',
            'anti_dose_given' => 'nullable|numeric|min:0', //0.2 ML
            'anti_tetanus_date_dose_given' => 'nullable|date',
     
            'route_of_administration' => 'required|string|max:255',
     
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
