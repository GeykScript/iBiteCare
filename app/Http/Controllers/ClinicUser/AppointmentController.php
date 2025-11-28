<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use App\Models\ClinicServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PatientAppointment;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentRescheduleMail;
use App\Mail\AppointmentCancelledMail;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;


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

        PatientAppointment::where('status', 'Pending')
            ->where('appointment_date', '<', now()->toDateString())
            ->delete();



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

        // Generate unique booking reference (DrCare-YYYYMMDD-XXX)
        $date = now()->format('Ymd');
        $lastAppointment = PatientAppointment::whereDate('created_at', today())->orderBy('id', 'desc')->first();
        $sequence = $lastAppointment ? (intval(substr($lastAppointment->booking_reference, -5)) + 1) : 1;
        $bookingReference = 'DrCare-' . $date . '-' . str_pad($sequence, 5, '0', STR_PAD_LEFT);

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
            'booking_reference' => $bookingReference,
        ]);

        return redirect()->back()->with('success', 'Appointment Booked Successfully.');
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

        if(!empty($appointment->contact_number)) {
            // Send SMS notification via Semaphore API
            $contactNumber = str_replace(' ', '', preg_replace(
                ['/^\+63/', '/^0/'],
                ['63', '63'],
                $appointment->contact_number
            ));

            $appointmentDate = Carbon::parse($request->appointment_date)->format('M, d, Y');
            $appointmentTime = Carbon::parse($request->appointment_time)->format('h:i A');

            $messageText = "Hello! This is Dr. Care ABC Guinobatan. Your appointment has been rescheduled to $appointmentDate at $appointmentTime."."
            \nFor any concerns, Call/Text: 0954 195 2374. Thank you!";

            // dd($contactNumber, $messageText);
                // Http::post('https://api.semaphore.co/api/v4/messages', [
                //         'apikey' => env('SEMAPHORE_API_KEY'),
                //         'number' => $contactNumber,
                //         'message' => $messageText,
                //         'sendername' => env('SEMAPHORE_SENDER_NAME'),
                //     ]);
            }

        if (!empty($request->email)) {
            $patientEmail = $request->email;
            Mail::to($patientEmail)->send(new AppointmentRescheduleMail($appointment));
    }
    
        return redirect()->back()->with('success', 'Appointment Rescheduled Successfully.');
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

        if ($request->status == 'Cancelled' && !empty($appointment->contact_number)) {
            // Send SMS notification via Semaphore API
            $contactNumber = str_replace(' ', '', preg_replace(
                ['/^\+63/', '/^0/'],
                ['63', '63'],
                $appointment->contact_number
            ));

            $appointmentDate = Carbon::parse($request->appointment_date)->format('M, d, Y');
            $appointmentTime = Carbon::parse($request->appointment_time)->format('h:i A');

            $messageText = "Hello! This is Dr. Care ABC Guinobatan. Your appointment scheduled on $appointmentDate at $appointmentTime has been cancelled.
            \nFor any concerns, call or text 0954 195 2374. Thank you!";

            // dd($contactNumber, $messageText);
            // Http::post('https://api.semaphore.co/api/v4/messages', [
            //     'apikey' => env('SEMAPHORE_API_KEY'),
            //     'number' => $contactNumber,
            //     'message' => $messageText,
            //     'sendername' => env('SEMAPHORE_SENDER_NAME'),
            // ]);
        }

        if ( $request->status == 'Cancelled' && !empty($appointment->email) ) {
            $patientEmail = $appointment->email;
            Mail::to($patientEmail)->send(new AppointmentCancelledMail($appointment));
        }

        return redirect()->back()->with('success', 'Status Updated Successfully.');
    }
}
