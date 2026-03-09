<?php

namespace Database\Factories;

use App\Models\Prescription;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrescriptionFactory extends Factory
{
    protected $model = Prescription::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'doctor_id' => 1, // Assume doctor with ID 1 exists (User with doctor role)
            'diagnosis' => $this->faker->sentence(),
            'notes' => $this->faker->paragraph(),
            'prescription_date' => now()->toDateString(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
