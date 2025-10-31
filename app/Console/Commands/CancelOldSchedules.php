<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CancelOldSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cancel-old-schedules';
    protected $description = 'Cancel pending schedules older than 1 month after last completed date';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('CancelOldSchedules ran at: ' . now());

        DB::statement("
        UPDATE patient_immunization_schedule s
        JOIN (
            SELECT 
                transaction_id,
                grouping,
                MAX(date_completed) AS last_completed
            FROM patient_immunization_schedule
            WHERE status = 'Completed'
            GROUP BY transaction_id, grouping
        ) AS c
        ON s.transaction_id = c.transaction_id
        AND s.grouping = c.grouping
        SET s.status = 'Cancelled'
        WHERE s.status = 'Pending'
          AND DATE_ADD(c.last_completed, INTERVAL 1 MONTH) < CURDATE();
    ");

        $this->info('Old pending schedules have been cancelled.');
    }
}
