<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Soufiane El Bahri',
                'role' => 'Patient Régulier',
                'content' => 'Une expérience exceptionnelle. La prise de rendez-vous est intuitive et le suivi médical est d\'une qualité rare. Je recommande vivement ce cabinet.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Laila Benjelloun',
                'role' => 'Maman de 2 enfants',
                'content' => 'Enfin un cabinet qui comprend l\'importance du numérique. Plus besoin d\'attendre au téléphone, tout se fait en quelques clics. Très pratique pour les parents.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Mehdi Alami',
                'role' => 'Patient',
                'content' => 'Le personnel est accueillant et les outils technologiques facilitent vraiment la vie. Le dossier médical partagé est un vrai plus pour mon suivi.',
                'rating' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
