<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'birth_date' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['Masculin', 'Féminin']),
            'nationality' => 'Marocaine',
            'cin' => $this->faker->bothify('??######'),
            'assurance' => $this->faker->randomElement(['ALLIANZ', 'WAFA', 'AXA', 'CNSS', 'CNOPS']),
            'num_assurance' => $this->faker->numerify('#####'),
            'langue_parlee' => 'Français, Arabe',
            'photo' => null,
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'is_majeur' => true,
            'groupe_sanguin' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'fratrie' => $this->faker->sentence(3),
            'voie_accouchement' => $this->faker->randomElement(['Vaginale', 'Césarienne']),
            'apgar' => '9/10',
            'allaitement' => $this->faker->randomElement(['Maternel', 'Artificiel', 'Mixte']),
            'developpement_psychomoteur' => 'Normal',
            'antecedents_familiaux' => $this->faker->sentence(),
            'allergies' => $this->faker->word(),
            'maladies_chroniques' => $this->faker->word(),
            'medicaments_cours' => $this->faker->word(),
            'antecedents_personnels' => $this->faker->sentence(),
            'hospitalisations' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
