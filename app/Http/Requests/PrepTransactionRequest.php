<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrepTransactionRequest extends FormRequest
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

            //previous rabies vaccination
            'immunization_type' => 'nullable|string|max:255',
            'date_dose_given' => 'nullable|date',
            'place_of_immunization' => 'nullable|string|max:255',

            // current vaccination details
            //active vaccine category
            'route_of_administration' => 'required|string|max:255',
            'active_vaccine_category' => 'required|in:PVRV,PCEC',
            'pvrv_vaccine_id' => 'nullable|integer',
            'pcec_vaccine_id' => 'nullable|integer',

          
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
