<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('doctors')->insert([
            [
                'first_name' => 'Alice',
                'last_name' => 'Martin',
                'specialty' => 'General',
                'phone' => '0625874939',
                'email' => 'alice@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Bob',
                'last_name' => 'Smith',
                'specialty' => 'Cardiology',
                'phone' => '0625874940',
                'email' => 'bob@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}