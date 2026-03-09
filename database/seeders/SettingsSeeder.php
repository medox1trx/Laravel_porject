<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'clinic_name' => 'Cabinet Médical MediCal',
            'clinic_phone' => '+212 5 22 00 00 00',
            'clinic_email' => 'contact@medical.ma',
            'clinic_address' => 'Imm G, Résidence Riad Nawal, A5 - 1er Etage, Bd Al Mouzdalifa, Marrakech',
            'clinic_description' => 'Cabinet de médecine générale et spécialisée',
            'default_appointment_duration' => '30',
            'opening_time' => '08:00',
            'closing_time' => '18:00',
            'working_days' => 'monday,tuesday,wednesday,thursday,friday',
            'notifications_enabled' => '1',
            'reminder_hours_before' => '24',
        ];

        foreach ($defaults as $key => $value) {
            Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
            );
        }
    }
}
