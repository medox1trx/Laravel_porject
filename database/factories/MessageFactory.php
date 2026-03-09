<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'user_id' => 1, // Assume admin user exists
            'content' => $this->faker->realText(200),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
