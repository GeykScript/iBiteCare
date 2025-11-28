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


    public function sendSingleMessage(Request $request){
        // dd($request->all());
        $request->merge([
            'contact_number' => preg_replace(
                ['/^\+63/', '/^0/'],  // Match +63 or leading 0
                ['63', '63'],         // Replace both with 63
                $request->contact_number
            ),
        ]);

        $request->validate([
            'message_id' => 'required|integer',
            'contact_number' => 'required|string',
            'message' => 'required|string',
        ]);


        $response = Http::post('https://api.semaphore.co/api/v4/messages', [
            'apikey' => env('SEMAPHORE_API_KEY'),
            'number' => $request->contact_number,
            'message' => $request->message,
            'sendername' => env('SEMAPHORE_SENDER_NAME'),
        ]);

        if ($response->successful()) {
            // Message sent successfully
            Messages::where('id', $request->message_id)
                ->update([
                    'status' => 'Sent',
                ]);

        } else {
            return redirect()->back()
                ->with('sent-error', 'Failed to send message: ' . $response->body());
        }
     
        return redirect()->route('clinic.messages')->with('sent-success', 'Message sent successfully!');
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

        $contactNumber = str_replace(' ', '', preg_replace(
            ['/^\+63/', '/^0/'],
            ['63', '63'],
            $patient->contact_number
        ));

        //Send message via Semaphore API
        $response = Http::post('https://api.semaphore.co/api/v4/messages', [
            'apikey' => env('SEMAPHORE_API_KEY'),
            'number' => $contactNumber,
            'message' => $request->message,
            'sendername' => env('SEMAPHORE_SENDER_NAME'),
        ]);


        if ($response->successful()) {
            // Add messages
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

            // Send message (will throw an exception if not successful)
            $response = Http::post('https://api.semaphore.co/api/v4/messages', [
                'apikey' => env('SEMAPHORE_API_KEY'),
                'number' => $contactNumber,
                'message' => $messageText,
                'sendername' => env('SEMAPHORE_SENDER_NAME'),
            ]);

            if ($response->successful()) {
                // Message sent successfully
                Messages::where('id', $messageId)
                    ->update([
                        'status' => 'Sent',
                    ]);
            } else {
                return redirect()->back()
                    ->with('sent-error', 'Failed to send message: ' . $response->body());
            }
          
        }

        return redirect()->route('clinic.messages')
            ->with('sent-success', 'Messages sent successfully!');
    }
    
}
