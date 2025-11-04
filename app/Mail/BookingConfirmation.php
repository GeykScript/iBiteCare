<?php

namespace App\Mail;


use App\Models\PatientAppointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public PatientAppointment $booking;

    public function __construct(PatientAppointment $booking)
    {
        $this->booking = $booking;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Confirmation - Animal Bite Center',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_confirmation',
        );
    }
}