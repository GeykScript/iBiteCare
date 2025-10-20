<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;
use App\Models\Messages;
use Illuminate\Support\Facades\Http;


class MessagesController extends Controller
{
    public function index()
    {
        $clinicUser = Auth::guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access the patients list.');
        }

        $messages = Messages::all()
            ->where('scheduled_send_date', now()->toDateString());
            
        return view('ClinicUser.messages', compact('clinicUser', 'messages'));
    }


    public function sendSingleMessage(Request $request){
        // dd($request->all());
        $request->validate([
            'message_id' => 'required|integer',
            'contact_number' => 'required|string',
            'message' => 'required|string',
        ]);


        $response = Http::post('https://api.semaphore.co/api/v4/messages', [
            'apikey' => env('SEMAPHORE_API_KEY'),
            'number' => '639916863623',
            'message' => 'Hello! This is an appointment reminder from Dr. Care Guinobatan Clinic.',
        ]);

        dd([
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        // info("Sending message ID: {$request->message_id} to Contact: {$request->contact_number} with Message: {$request->message}");
        Messages::where('id', $request->message_id)
            ->update([
                'status' => 'Sent',
            ]);

        return redirect()->route('clinic.messages')->with('sent-success', 'Message sent successfully!');
    }

    public function sendAllMessages(Request $request)
    {
        $request->validate([
            'messages' => 'required|string',
        ]);

        $messageIds = json_decode($request->messages, true);

        // Get messages with related patient
        $messages = Messages::with('patient')->whereIn('id', $messageIds)->get();

        foreach ($messages as $message) {
            // Example: you can log or process values
            $messageId = $message->id;
            $contactNumber = $message->patient->contact_number ?? 'No contact';
            $contactNumber = preg_replace('/\s+/', '', $contactNumber);

            $displayMessage = $message->display_message;
            $messageText = $message->message_text;

            // Send SMS logic here, e.g.
            // SmsService::send($contactNumber, $displayMessage);

            // For debugging without stopping execution:
            info("Message ID: $messageId, Contact: $contactNumber, Message: $messageText");
        }

        // Optionally update all messages to 'Sent'
        // Messages::whereIn('id', $messageIds)->update(['status' => 'Sent']);

        return redirect()->route('clinic.messages')->with('sent-success', 'All messages sent successfully!');
    }
}
