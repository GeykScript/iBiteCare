<?php

namespace App\Http\Controllers;

use App\Models\PatientAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Models\ClinicServices;

class BookingController extends Controller
{
    public function index()
    {
        // Get all appointments for the logged-in user
        $appointments = PatientAppointment::where('patient_account_id', Auth::id())
            ->orderBy('appointment_date', 'desc')
            ->get();

        // Convert appointments to a simple JSON-safe array for JS
        $appointmentsJson = $appointments->map(function ($a) {
            return [
                'id' => $a->id,
                'name' => $a->name,
                'contact_number' => $a->contact_number,
                'email' => $a->email,
                'treatment_type' => $a->treatment_type,
                'appointment_date' => $a->appointment_date,
                'appointment_time' => $a->appointment_time,
                'status' => $a->status ?? 'pending',
                'additional_notes' => $a->additional_notes,
            ];
        });

        $services = ClinicServices::all();

        // Pass both variables to the Blade view
        return view('auth.booking', compact('appointments', 'appointmentsJson', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'treatment_type' => 'required|in:pep,prep,boosters',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    $count = PatientAppointment::where('appointment_date', $request->appointment_date)
                        ->where('appointment_time', $value)
                        ->count();
                    if ($count >= 10) {
                        $fail('This time slot is fully booked. Please choose another time.');
                    }
                },
            ],
            'additional_notes' => 'nullable|string|max:1000',
        ]);

        
        $validated['patient_account_id'] = Auth::id();
        $validated['booking_channel'] = 'online';
        $validated['status'] = 'Pending';

        // Create the appointment
        $appointment = PatientAppointment::create($validated);

        // Send confirmation email
        Mail::to($appointment->email)->send(new BookingConfirmation($appointment));


        return back()->with('success', 'Your appointment has been booked successfully!');
    }

    public function getAvailableSlots(Request $request)
    {
        $date = $request->query('date');
        $allSlots = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00'];
        $availableSlots = [];

        foreach ($allSlots as $slot) {
            $count = PatientAppointment::where('appointment_date', $date)
                ->where('appointment_time', $slot)
                ->count();
            if ($count < 10) {
                $availableSlots[] = $slot;
            }
        }

        return response()->json($availableSlots);
    }
    public function cancel($id)
    {
        $appointment = PatientAppointment::where('id', $id)
            ->where('patient_account_id', Auth::id())
            ->firstOrFail();

        $appointment->status = 'Cancelled'; 
        $appointment->save();

        return response()->json(['message' => 'Appointment cancelled successfully']);
    }
    public function reschedule(Request $request, $id)
    {
        $appointment = PatientAppointment::where('id', $id)
            ->where('patient_account_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required|string',
        ]);

        $appointment->update([
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
        ]);

        return response()->json([
            'message' => 'Appointment rescheduled successfully',
            'appointment' => $appointment,
        ]);
    }


}