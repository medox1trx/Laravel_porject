<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('patients')->insert([
            [
                'first_name' => 'Mohamed',
                'last_name' => 'Ali',
                'phone' => '0621936161',
                'email' => 'mohamed@example.com',
                'birth_date' => '1992-03-05',
                'gender' => 'Male',
                'address' => '123 Main St',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Sara',
                'last_name' => 'Khalid',
                'phone' => '0621936162',
                'email' => 'sara@example.com',
                'birth_date' => '1995-07-15',
                'gender' => 'Female',
                'address' => '456 Elm St',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}