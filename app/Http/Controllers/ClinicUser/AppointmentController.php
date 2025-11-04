<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use App\Models\ClinicServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PatientAppointment;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentRescheduleMail;

class AppointmentController extends Controller
{
    //

    public function index()
    {

        $clinicUser = Auth::guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access the patients list.');
        }
        //
        $services = ClinicServices::all();


        return view('ClinicUser.appointment',compact('clinicUser', 'services'));
    }


    public function bookAppointment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'treatment_type' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string|max:10',
            'channel' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Create a new appointment
        PatientAppointment::create([
            'name' => $request->name,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'treatment_type' => $request->treatment_type,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'booking_channel' => $request->channel,
            'additional_notes' => $request->notes,
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Appointment booked successfully.');
    }


    public function reschedule(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|integer',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string',
            'email' => 'nullable|email|max:255',
        ]);

        // Find the appointment by ID
        $appointment = PatientAppointment::find($request->appointment_id);

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found.');
        }

        // Update the appointment details
        $appointment->appointment_date = $request->appointment_date;
        $appointment->appointment_time = $request->appointment_time;
        $appointment->status = 'Pending';
        $appointment->save();

        if($patientEmail = $request->email && !empty($request->email)) {
            // Send reschedule email to patient
            Mail::to($patientEmail)->send(new AppointmentRescheduleMail($appointment));
        }

        return redirect()->back()->with('success', 'Appointment rescheduled successfully.');
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|integer',
            'status' => 'required|string',
        ]);

        // Find the appointment by ID
        $appointment = PatientAppointment::find($request->appointment_id);

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found.');
        }

        // Update the appointment status
        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }
}
