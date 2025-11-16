<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\Messages;


class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        Notifications::where('is_read', 0)
            ->update(['is_read' => 1]);

        return response()->json(['success' => true]);
    }


    // Get notifications (insert pending SMS if needed)
    public function getNotifications()
    {
        $clinic_expected_patients = Messages::where('scheduled_send_date', now()->toDateString())
            ->count();

        // Only insert a notification if there are pending messages AND no existing notification for today
        if ($clinic_expected_patients > 0) {
            $existing = Notifications::whereDate('created_at', now()->toDateString())
                ->where('content', 'like', '%pending SMS messages%')
                ->first();

            if (!$existing) {
                Notifications::insert([
                    'content' => 'You have ' . $clinic_expected_patients . ' pending SMS messages to send today.',
                    'is_read' => 0,
                    'links_to' => 2, // links to messages
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $notifications = Notifications::orderBy('created_at', 'desc')->get();

        return response()->json($notifications);
    }
}
