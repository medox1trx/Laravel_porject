<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with('patient', 'doctor')->latest()->get();
        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create(Request $request)
    {
        $patients = Patient::all();
        $selectedPatientId = $request->patient_id;
        return view('prescriptions.create', compact('patients', 'selectedPatientId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diagnosis' => 'nullable|string',
            'notes' => 'nullable|string',
            'prescription_date' => 'required|date',
            'medicines' => 'required|array|min:1',
            'medicines.*.name' => 'required|string',
            'medicines.*.dosage' => 'required|string',
            'medicines.*.duration' => 'nullable|string',
        ]);

        $prescription = Prescription::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => Auth::id(),
            'diagnosis' => $request->diagnosis,
            'notes' => $request->notes,
            'prescription_date' => $request->prescription_date,
        ]);

        foreach ($request->medicines as $item) {
            $prescription->items()->create([
                'medicine_name' => $item['name'],
                'dosage' => $item['dosage'],
                'duration' => $item['duration'],
            ]);
        }

        return redirect()->route('prescriptions.show', $prescription->id)
            ->with('success', 'Ordonnance générée avec succès.');
    }

    public function show($id)
    {
        $prescription = Prescription::with('patient', 'doctor', 'items')->findOrFail($id);
        return view('prescriptions.show', compact('prescription'));
    }

    public function print($id)
    {
        $prescription = Prescription::with('patient', 'doctor', 'items')->findOrFail($id);
        return view('prescriptions.print', compact('prescription'));
    }
}
