<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('appointments')->insert([
            [
                'doctor_id' => 1,
                'patient_id' => 1,
                'appointment_date' => '2026-03-25',
                'appointment_time' => '10:00:00',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doctor_id' => 2,
                'patient_id' => 2,
                'appointment_date' => '2026-03-26',
                'appointment_time' => '14:30:00',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}