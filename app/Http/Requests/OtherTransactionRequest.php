<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtherTransactionRequest extends FormRequest
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
            'patient_id' => 'required|integer',
           

            'temperature' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'blood_pressure' => 'nullable|string|max:255',

            'vaccine_id' => 'nullable|integer',
            'dose_given' => 'nullable|numeric|min:0',
            'immunization_type' => 'nullable|string|max:255',

            'vaccine_date_dose_given' => 'nullable|date',
            'route_of_administration' => 'required|string|max:255',

            //nurse
            'nurse_id' => 'required|integer',

            //step 5: payment
            'datetime_today' => 'required|date',
            'dateOfTransaction' => 'required|date',
            'staff_id' => 'required|integer',
            'total_amount' => 'required|numeric|min:0',
        ];
    }
}
