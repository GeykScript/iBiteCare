<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ClinicTransactions;
use App\Models\Patient;

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
    public function __construct($patientId, $subjectLine, $messageBody = null)
    {
        // Load patient
        $this->patient = Patient::findOrFail($patientId);
        $this->subjectLine = $subjectLine;
        $this->messageBody = $messageBody;

        // Fetch patient transactions
        $this->transactions2 = ClinicTransactions::with([
            'patient',
            'service',
            'paymentRecords',
            'immunizations',
            'patientExposures',
            'patientSchedules'
        ])
            ->where('patient_id', $patientId)
            ->orderBy('transaction_date', 'asc')
            ->get()
            ->groupBy('grouping')
            ->map(function ($group) {
                $first = $group->first();
                $first->allSchedules = $group->flatMap->patientSchedules;
                return $first;
            })
            ->sortByDesc('transaction_date');
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
        <p>Thank you for visiting <strong>Dr. Care Animal Bite Center</strong>. Here is your <strong>Vaccination Card</strong> for your recent immunization.</p>
        <p>Please keep this document for your medical records. If you need any assistance, feel free to reach out to us anytime.</p>
        <p>Warm regards,<br>
        <strong>Dr. Care Animal Bite Center Team</strong></p>
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
