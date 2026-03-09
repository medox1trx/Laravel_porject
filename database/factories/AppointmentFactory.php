<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'doctor_id' => 1, // Assume doctor with ID 1 exists or use Doctor::factory() if needed
            'date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'type' => $this->faker->randomElement(['Consultation', 'Contrôle', 'Urgence']),
            'status' => $this->faker->randomElement(['planned', 'completed', 'cancelled']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
