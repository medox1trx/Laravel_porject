<?php

namespace Database\Factories;

use App\Models\PrescriptionItem;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrescriptionItemFactory extends Factory
{
    protected $model = PrescriptionItem::class;

    public function definition(): array
    {
        return [
            'prescription_id' => Prescription::factory(),
            'medicine_name' => $this->faker->word() . ' ' . $this->faker->randomFloat(2, 50, 500) . 'mg',
            'dosage' => '1 comprimé ' . $this->faker->randomElement(['2 fois par jour', '3 fois par jour', 'le soir', 'le matin']),
            'duration' => $this->faker->randomDigitNotNull() . ' jours',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
