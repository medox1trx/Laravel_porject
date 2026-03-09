<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class SettingsController extends Controller
{
    /**
     * Clés autorisées pour les paramètres de la clinique & système.
     */
    private array $allowedKeys = [
        'clinic_name',
        'clinic_phone',
        'clinic_email',
        'clinic_address',
        'clinic_description',
        'default_appointment_duration',
        'opening_time',
        'closing_time',
        'working_days',
        'notifications_enabled',
        'reminder_hours_before',
    ];

    public function index()
    {
        $settings = [];
        foreach ($this->allowedKeys as $key) {
            $settings[$key] = Setting::get($key, '');
        }

        // Working days: stored as comma-separated string -> array for the view
        $workingDays = array_filter(explode(',', $settings['working_days'] ?? ''));

        return view('settings.index', compact('settings', 'workingDays'));
    }

    public function update(Request $request)
    {
        $tab = $request->input('tab', 'clinic');

        if ($tab === 'clinic') {
            $validated = $request->validate([
                'clinic_name' => 'required|string|max:255',
                'clinic_phone' => 'nullable|string|max:30',
                'clinic_email' => 'nullable|email|max:255',
                'clinic_address' => 'nullable|string|max:500',
                'clinic_description' => 'nullable|string|max:1000',
            ]);

            foreach ($validated as $key => $value) {
                Setting::set($key, $value);
            }

            return back()->with('success', 'Informations de la clinique mises à jour avec succès.')->with('active_tab', 'clinic');
        }

        if ($tab === 'appointments') {
            $validated = $request->validate([
                'default_appointment_duration' => 'required|integer|min:5|max:240',
                'opening_time' => 'required|string',
                'closing_time' => 'required|string',
                'working_days' => 'nullable|array',
                'working_days.*' => 'string',
            ]);

            Setting::set('default_appointment_duration', $validated['default_appointment_duration']);
            Setting::set('opening_time', $validated['opening_time']);
            Setting::set('closing_time', $validated['closing_time']);
            Setting::set('working_days', implode(',', $validated['working_days'] ?? []));

            return back()->with('success', 'Paramètres des rendez-vous mis à jour.')->with('active_tab', 'appointments');
        }

        if ($tab === 'notifications') {
            $notificationsEnabled = $request->has('notifications_enabled') ? '1' : '0';
            Setting::set('notifications_enabled', $notificationsEnabled);
            Setting::set('reminder_hours_before', $request->input('reminder_hours_before', 24));

            return back()->with('success', 'Préférences de notifications mises à jour.')->with('active_tab', 'notifications');
        }

        if ($tab === 'security') {
            $validated = $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
                'new_password_confirmation' => 'required|string',
            ]);

            $user = Auth::user();

            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()
                    ->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.'])
                    ->with('active_tab', 'security');
            }

            $user->update(['password' => $validated['new_password']]);

            return back()->with('success', 'Mot de passe modifié avec succès.')->with('active_tab', 'security');
        }

        return back()->with('active_tab', 'clinic');
    }
}
