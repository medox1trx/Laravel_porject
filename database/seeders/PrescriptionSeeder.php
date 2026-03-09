<?php

namespace Database\Seeders;

use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;

class PrescriptionSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $doctor = User::where('role', 'doctor')->first();

        if ($patients->isEmpty() || !$doctor) {
            return;
        }

        foreach ($patients as $patient) {
            Prescription::factory()
                ->count(1)
                ->create([
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
            ])
                ->each(function ($prescription) {
                PrescriptionItem::factory()->count(rand(2, 5))->create([
                    'prescription_id' => $prescription->id,
                ]);
            });
        }
    }
}
