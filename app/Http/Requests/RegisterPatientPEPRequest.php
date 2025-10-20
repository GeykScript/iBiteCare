<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPatientPEPRequest extends FormRequest
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
            'sex' => 'string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer|min:0',

            'temperature' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'blood_pressure' => 'nullable|string|max:255',

            // Step 2: Exposure Details
            'date_of_bite' => 'required|date',
            'time_of_bite' => 'required|date_format:H:i',
            'location_of_incident' => 'nullable|string|max:255',
            'exposure' => 'required|in:Bite,Non-Bite',
            'selectedPart' => 'required|string|max:500',
            'bite_category' => 'required|integer',
            'pep_immunization_type' => 'required|in:Active,Passive/Active,None',
            'bite_management' => 'nullable|string|max:255',

            // Step 3: Animal Profile
            'species' => 'required|string|max:255',
            'clinical_status' => 'required|in:Healthy,Sick,Died,Killed,Lost',
            'ownership_status' => 'required|in:Owned,Neighbor,Stray',
            'brain_exam' => 'nullable|string|max:255',
            'brain_exam_location' => 'nullable|string|max:255',
            'brain_exam_results' => 'nullable|string|max:255',

            // Step 4: A. Previous Anti-Tetanus Vaccination
            // previous anti-tetanus vaccination
            'year_last_dose_given' => 'nullable|date_format:Y',
            'anti_tetanus_dose_given' => 'nullable|string|max:255', //TT1,TT2,TT3
            'anti_tetanus_vaccine_id' => 'nullable|integer',
            'anti_dose_given' => 'nullable|numeric|min:0', //0.2 ML
            'anti_tetanus_date_dose_given' => 'nullable|date',

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
            'vaccine_dose_given' => 'nullable|numeric|min:0', //0.2 ML


            // passive vaccine category
            'passive_rig_category' => 'nullable|in:ERIG,HRIG',
            'erig_vaccine_id' => 'nullable|integer',
            'hrig_vaccine_id' => 'nullable|integer',
            'passive_dose_given' => 'nullable|numeric|min:0',
            'passive_date_given' => 'nullable|date',

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
