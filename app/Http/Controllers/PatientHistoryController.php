<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PatientHistory;
use Illuminate\Http\Request;

class PatientHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($patientId)
    {
        // Fetch all histories for this specific patient
        $histories = PatientHistory::where('patient_id', $patientId)
            ->with('patient') // eager load patient details
            ->get();

        return view('patient.histories.index', compact('histories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $patient)
    {  
        return view('patient.histories.create', compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $patient)
    {
        $request->validate([
            'diagnosis' => 'nullable|string|max:1000',
            "treatment" => 'nullable|string|max:1000',
            'visit_date' => 'required|date',
        ]);

        PatientHistory::create([
            'patient_id' => $patient->id,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'visit_date' => $request->visit_date,
        ]);

        return redirect()->route('patients.histories.index', $patient->id)
                         ->with('success', 'Patient history added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $patient, PatientHistory $history)
    {
        return view('patient.histories.show', compact('patient', 'history'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $patient, PatientHistory $history)
{
    return view('patient.histories.edit', compact('patient', 'history'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $patientId, $historyId)
    {
        $request->validate([
            'diagnosis' => 'nullable|string|max:1000',
            'treatment' => 'nullable|string|max:1000',
            'visit_date' => 'required|date',
        ]);

        $history = PatientHistory::where('patient_id', $patientId)
                    ->where('id', $historyId)
                    ->firstOrFail();

        $history->update([
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'visit_date' => $request->visit_date,
        ]);

        return redirect()
                ->route('patients.histories.index', $patientId)
                ->with('success', 'Patient history updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    // first define a route in web.php
    // Route::delete('/patients/{patient}/histories/{history}', [PatientHistoryController::class, 'destroy'])->name('patients.histories.destroy');
    public function destroy(User $patient, PatientHistory $history)
    {
        $history->delete();
        return redirect()
            ->route('patients.histories.index', $patient->id) 
            ->with('success', 'Patient history deleted successfully!');
    }
}
