<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppointmentTime;

class AppointmentTimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define array of appointment times and dates
        $appointmentData = [
            ['user_id' => 1, 'date' => '2024-05-01', 'times' => ['09:00:00', '10:00:00', '11:00:00']],
            ['user_id' => 1, 'date' => '2024-05-02', 'times' => ['09:30:00', '10:30:00', '11:30:00']],
            // Add more appointment times and dates as needed
        ];

        // Loop through the appointment data array
        foreach ($appointmentData as $data) {
            // Extract date and times from data
            $date = $data['date'];
            $times = $data['times'];

            // Create appointment times for each time slot
            foreach ($times as $time) {
                // Create appointment time record
                AppointmentTime::create([
                    'user_id' => $data['user_id'],
                    'date' => $date,
                    'time' => $time
                ]);
            }
        }
    }
}