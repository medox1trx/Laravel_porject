<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'doctor');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $doctors = $query->latest()->paginate(5);

        // Link specialty from Doctor table if available (by email)
        $emails = $doctors->pluck('email');
        $doctorRecords = Doctor::whereIn('email', $emails)->get()->keyBy('email');

        $doctors->each(function($user) use ($doctorRecords) {
            $user->specialty = $doctorRecords->get($user->email)?->specialty ?? 'N/A';
        });

        return view('doctors.index', compact('doctors'));
    }

    public function show(string $id)
    {
        $doctor = User::where('role', 'doctor')->findOrFail($id);
        $doctorRecord = Doctor::where('email', $doctor->email)->first();
        $doctor->specialty = $doctorRecord ? $doctorRecord->specialty : 'N/A';

        return view('doctors.show', compact('doctor'));
    }
}
