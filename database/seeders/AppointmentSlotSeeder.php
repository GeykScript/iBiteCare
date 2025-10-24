<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppointmentSlot;

class AppointmentSlotSeeder extends Seeder
{
    public function run(): void
    {
        $slots = [
            ['start_time' => '09:00', 'end_time' => '10:00', 'max_bookings' => 5, 'is_active' => true],
            ['start_time' => '10:00', 'end_time' => '11:00', 'max_bookings' => 5, 'is_active' => true],
            ['start_time' => '11:00', 'end_time' => '12:00', 'max_bookings' => 5, 'is_active' => true],
            ['start_time' => '13:00', 'end_time' => '14:00', 'max_bookings' => 5, 'is_active' => true],
            ['start_time' => '14:00', 'end_time' => '15:00', 'max_bookings' => 5, 'is_active' => true],
            ['start_time' => '15:00', 'end_time' => '16:00', 'max_bookings' => 5, 'is_active' => true],
        ];

        foreach ($slots as $slot) {
            AppointmentSlot::create($slot);
        }
    }
}
