<?php

namespace App\Http\Controllers;

use App\Models\PatientAppointment;
use App\Models\AppointmentSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Models\ClinicServices;

class BookingController extends Controller
{
    public function index()
    {
        $appointments = PatientAppointment::where('patient_account_id', Auth::id())
            ->orderBy('appointment_date', 'desc')
            ->get();

        $appointmentsJson = $appointments->map(function ($a) {
            return [
                'id' => $a->id,
                'booking_reference' => $a->booking_reference,
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

        return view('auth.booking', compact('appointments', 'appointmentsJson', 'services'));
    }

    public function store(Request $request)
    {
        $hasActiveAppointment = PatientAppointment::where('patient_account_id', Auth::id())
            ->whereNotIn('status', ['Arrived', 'Cancelled'])
            ->exists();

        if ($hasActiveAppointment) {
            return back()->with('error', 'You already have an active appointment. Please finish or cancel it before booking a new one.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'treatment_type' => 'required|string|max:255',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    $slot = AppointmentSlot::where('start_time', $value)->where('is_active', true)->first();
                    if (!$slot) {
                        $fail('This slot is not available.');
                    }
                },
            ],
            'additional_notes' => 'nullable|string|max:1000',
        ]);

        // Generate unique booking reference (DrCare-YYYYMMDD-XXX)
        $date = now()->format('Ymd');
        $lastAppointment = PatientAppointment::whereDate('created_at', today())->orderBy('id', 'desc')->first();
        $sequence = $lastAppointment ? (intval(substr($lastAppointment->booking_reference, -5)) + 1) : 1;
        $bookingReference = 'DrCare-' . $date . '-' . str_pad($sequence, 5, '0', STR_PAD_LEFT);

        $validated['patient_account_id'] = Auth::id();
        $validated['booking_channel'] = 'Online';
        $validated['status'] = 'Pending';
        $validated['booking_reference'] = $bookingReference;

        $appointment = PatientAppointment::create($validated);
        Mail::to($appointment->email)->send(new BookingConfirmation($appointment));

        return back()->with('success', 'Your appointment has been booked successfully! Booking ID: ' . $bookingReference);
    }

    public function getAvailableSlots(Request $request)
    {
        $date = date('Y-m-d', strtotime($request->query('date')));

        $slots = AppointmentSlot::where('is_active', true)->get();

        $slotCounts = PatientAppointment::whereDate('appointment_date', $date)
            ->selectRaw('TIME_FORMAT(appointment_time, "%H:%i:%s") as appointment_time, COUNT(*) as count')
            ->groupBy('appointment_time')
            ->pluck('count', 'appointment_time');

        $availableSlots = [];

        foreach ($slots as $slot) {
            $slotTime = date('H:i:s', strtotime($slot->start_time));
            $count = $slotCounts[$slotTime] ?? 0;

            if ($count < $slot->max_bookings) {
                $availableSlots[] = date('H:i', strtotime($slot->start_time));
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