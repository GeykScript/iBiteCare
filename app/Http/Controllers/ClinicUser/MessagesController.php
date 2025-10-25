<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;
use App\Models\Messages;
use App\Models\Patient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class MessagesController extends Controller
{
    public function index()
    {
        $clinicUser = Auth::guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access the patients list.');
        }

        $messages = Messages::all()
            ->where('status', 'Pending');
        
        $todayMessages = Messages::all()
            ->where('scheduled_send_date', now()->toDateString())
            ->where('status', 'Pending');
        
        $patients = Patient::all();

        return view('ClinicUser.messages', compact('clinicUser', 'messages', 'todayMessages', 'patients'));
    }


    // public function sendSingleMessage(Request $request){
    //     // dd($request->all());
    //     $request->merge([
    //         'contact_number' => preg_replace(
    //             ['/^\+63/', '/^0/'],  // Match +63 or leading 0
    //             ['63', '63'],         // Replace both with 63
    //             $request->contact_number
    //         ),
    //     ]);

    //     $request->validate([
    //         'message_id' => 'required|integer',
    //         'contact_number' => 'required|string',
    //         'message' => 'required|string',
    //     ]);

    //     dd($request->contact_number);



    //     // $response = Http::post('https://api.semaphore.co/api/v4/messages', [
    //     //     'apikey' => env('SEMAPHORE_API_KEY'),
    //     //     'number' => '639916863623',
    //     //     'message' => 'Hello! This is an appointment reminder from Dr. Care Guinobatan Clinic.',
    //     // ]);


    //     dd([
    //         'status' => $response->status(),
    //         'body' => $response->body(),
    //     ]);

    //     // info("Sending message ID: {$request->message_id} to Contact: {$request->contact_number} with Message: {$request->message}");
    //     Messages::where('id', $request->message_id)
    //         ->update([
    //             'status' => 'Sent',
    //         ]);

    //     return redirect()->route('clinic.messages')->with('sent-success', 'Message sent successfully!');
    // }

    public function sendSingleMessage(Request $request)
    {
        // Normalize contact number format
        $request->merge([
            'contact_number' => preg_replace(
                ['/^\+63/', '/^0/'],
                ['63', '63'],
                $request->contact_number
            ),
        ]);

        // Validate request
        $request->validate([
            'message_id' => 'required|integer',
            'contact_number' => 'required|string',
            'message' => 'required|string',
        ]);

        // Prepare SMS data
        $data = [
            'api_token' => env('IPROG_SMS_API_TOKEN'), // store your token in .env
            'message' => $request->message,
            'phone_number' => $request->contact_number,
        ];

        // Send to iProg SMS API
        $response = Http::asForm()->post('https://sms.iprogtech.com/api/v1/sms_messages', $data);

        
    
        if ($response->successful()) {
           // Update message status
            Messages::where('id', $request->message_id)->update([
                'status' => 'Sent',
            ]);

            return redirect()->route('clinic.messages')
                ->with('sent-success', 'Message sent successfully!');
        } else {
            return redirect()->back()
                ->with('sent-error', 'Failed to send message: ' . $response->body());
        }
    }


    public function sendNewMessage(Request $request)
    {
      
        // Validate request
        $request->validate([
            'patient_id' => 'required|integer',
            'message' => 'required|string',
            'subject' => 'required|string',
        ]);

        // Fetch patient contact number
        $patient = Patient::find($request->patient_id);
        if (!$patient) {
            return redirect()->back()->with('sent-error', 'Patient not found.');
        }
        $contactNumber = preg_replace(
            ['/^\+63/', '/^0/'],
            ['63', '63'],
            $patient->contact_number
        );

        // Prepare SMS data
        $data = [
            'api_token' => env('IPROG_SMS_API_TOKEN'), // store your token in .env
            'message' => $request->message,
            'phone_number' => $contactNumber,
        ];

        // Send to iProg SMS API
        $response = Http::asForm()->post('https://sms.iprogtech.com/api/v1/sms_messages', $data);


        if ($response->successful()) {
            // Update message status
            Messages::create([
                'patient_id' => $request->patient_id,
                'scheduled_send_date' => now()->toDateString(),
                'display_message' => $request->subject,
                'message_text' => $request->message,
                'status' => 'Sent',
            ]);

            return redirect()->route('clinic.messages')
                ->with('sent-success', 'Message sent successfully!');
        } else {
            return redirect()->back()
                ->with('sent-error', 'Failed to send message: ' . $response->body());
        }
    }

    public function sendAllMessages(Request $request)
    {
        $request->validate([
            'messages' => 'required|string',
        ]);

        $messageIds = json_decode($request->messages, true);

        // Fetch messages with patient relationship
        $messages = Messages::with('patient')->whereIn('id', $messageIds)->get();

        foreach ($messages as $message) {
            $messageId = $message->id;

            // Normalize contact number (convert to 63 format)
            $contactNumber = preg_replace(['/^\+?63/', '/^0/'], ['63', '63'], preg_replace('/\D/', '', $message->patient->contact_number));

            // Message content
            $messageText = $message->message_text;

            // Prepare data for API
            $data = [
                'api_token' => env('IPROG_SMS_API_TOKEN'),
                'message' => $messageText,
                'phone_number' => $contactNumber,
            ];

            try {
                // Send message to iProg API
                $response = Http::asForm()->post('https://sms.iprogtech.com/api/v1/sms_messages', $data);

                if ($response->successful()) {
                    // Log success for debugging
                    Log::info("Sent Message ID: {$messageId} to {$contactNumber}");

                    // Mark message as sent
                    Messages::where('id', $messageId)->update([
                        'status' => 'Sent',
                    ]);
                } else {
                    // Log failure
                    Log::error(" Failed to send Message ID: {$messageId}", [
                        'response' => $response->body(),
                    ]);
                }
            } catch (\Exception $e) {
                // Log exceptions (e.g., network error)
                Log::error("Error sending Message ID: {$messageId}", [
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return redirect()->route('clinic.messages')
            ->with('sent-success', 'All messages processed and queued successfully!');
    }
}
