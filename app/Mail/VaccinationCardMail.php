<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class VaccinationCardMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transactions2;
    public $patient;
    public $subjectLine;
    public $messageBody;

    /**
     * Create a new message instance.
     */
    public function __construct($transactions2, $patient, $subjectLine, $messageBody = null)
    {
        $this->transactions2 = $transactions2;
        $this->patient = $patient;
        $this->subjectLine = $subjectLine;
        $this->messageBody = $messageBody;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $name = trim($this->patient->first_name . ' ' . $this->patient->last_name);

        // Generate the Vaccination Card PDF
        $pdf = Pdf::loadView('ClinicUser.emails.vaccination-card', [
            'transactions2' => $this->transactions2
        ])->setPaper([0, 0, 612, 936], 'portrait');

        // Default message if none is provided
        $body = $this->messageBody ?? "
            <p>Dear {$name},</p>
            <p>We hope you are doing well. Here is your <strong>Vaccination Card</strong> in PDF format for your reference and safekeeping.</p>
            <p>If you have any questions or need further assistance, please don’t hesitate to contact our clinic.</p>
            <p>Best regards,<br>
            <strong>iBiteCare+</strong></p>
        ";

        return $this->subject($this->subjectLine)
            ->html($body)
            ->attachData($pdf->output(), 'vaccination_card.pdf', [
                'mime' => 'application/pdf',
            ]);
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
