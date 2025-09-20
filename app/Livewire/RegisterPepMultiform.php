<?php

namespace App\Livewire;

use Livewire\Component;

class RegisterPepMultiform extends Component
{
    public $currentStep = 1;
    public $totalSteps = 7;

    // Example form fields
    public $first_name, $last_name, $middleInitial, $suffix, $dateOfRegistration, $date_of_birth, $sex, $phone, $age, $region, $province, $city, $barangay, $description; 
    public $username, $password, $confirmPassword;
    public $contact, $interests = [], $newsletter = false;

    protected $rules = [
        'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s\-]+$/u',
        'last_name' => 'required|string|max:255|regex:/^[a-zA-Z\s\-]+$/u',
        'middleInitial' => 'required|string|max:2',
        'suffix' => 'nullable|string|max:10',
        'dateOfRegistration' => 'required|date',
        'date_of_birth' => 'required|date',
        'age' => 'required|integer|min:0',
        'sex' => 'required|string',
        'phone' => 'required',
        'region' => 'required|string',
        'province' => 'required|string',
        'city' => 'required|string',
        'barangay' => 'required|string',
        'description' => 'required|string|max:255',
    ];

    public function nextStep()
    {
        $this->validateStep();
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    private function validateStep()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s\-]+$/u',
                'last_name' => 'required|string|max:255|regex:/^[a-zA-Z\s\-]+$/u',
                'middleInitial' => 'required|string|max:2',
                'suffix' => 'nullable|string|max:10',
                'dateOfRegistration' => 'required|date',
                'date_of_birth' => 'required|date',
                'age' => 'required|integer|min:0',
                'sex' => 'required|string',
                'phone' => 'required',
                'region' => 'required|string',
                'province' => 'required|string',
                'city' => 'required|string',
                'barangay' => 'required|string',
                'description' => 'required|string|max:255',
            ]);
        }

        if ($this->currentStep === 2) {
            $this->validate([
                'username' => 'required',
            ]);
        }

        if ($this->currentStep === 3) {
            $this->validate([
                'contact' => 'required',
            ]);
        }

        // Add step-specific rules for 4–7 here...
    }

 public function submit()
{
    $this->validate([
        'first_name' => 'required|string|max:255|regex:/^[a-zA-Z\s\-]+$/u',
        'last_name' => 'required|string|max:255|regex:/^[a-zA-Z\s\-]+$/u',
        'middleInitial' => 'required|string|max:2',
        'suffix' => 'nullable|string|max:10',
        'dateOfRegistration' => 'required|date',
        'dateOfBirth' => 'required|date',
        'sex' => 'required|string',
        'phone' => 'required',
        'region' => 'required|string',
        'province' => 'required|string',
        'city' => 'required|string',
        'barangay' => 'required|string',
        'description' => 'required|string|max:255',
        // add others for steps 4–7
    ]);

    // Save to DB
    // Patient::create([...]);

    session()->flash('message', 'Form submitted successfully!');
    $this->reset();
    $this->currentStep = 1;
}

    public function render()
    {
        return view('livewire.register-pep-multiform');
    }
}
