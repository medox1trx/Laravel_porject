<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index',compact('patients'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request -> validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => ['required','regex:/^(0[67]\d{8}|212[67]\d{8})$/'],
            'email'=>'email|max:255|unique:patients,email',
            'birth_date'=>'required',
            'gender' => 'required|in:male,female',
            'address' => 'nullable|string',
        ]);
        Patient::create($request->all());
        return redirect()->route('patients.index');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = Patient::findorFail($id);
        return view('patients.show',compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = Patient::findorFail($id);
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request -> validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^(0[67]\d{8}|212[67]\d{8})$/'],
            'email'=>'email|max:255|unique:patients,email,' .$id,
            'birth_date'=>'required',
            'gender' => 'required|in:male,female',
            'address' => 'nullable|string',
        ]);
        $patient = Patient::findorFail($id);
        $patient->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);
        return redirect()->route('patients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $patient = Patient::findorFail($id);
        $patient->delete();
        return redirect()->route('patients.index');
    }
}
