<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = User::role('patient')->get();
        return view('patient.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female,other'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
        ]);

        $credentials['password'] = Hash::make('password'); // ei am making default password for new users.. user will change it later on first login using forgot password option
 
        $user = User::create($credentials);
        $user->assignRole('patient');
         // return redirect()->intended('dashboard');
        return redirect()->route('patients.index')->with('success', 'Registered Successfully!');
        
        // return back()->with('error', 'Invalid credentials.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $patient)
    {
        return view('patient.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $patient)
    {
        return view ('patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $patient)
    {
        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', 'unique:users,email,' . $patient->id],
            'gender' => ['required', 'in:male,female,other'],
            'age'    => ['required', 'integer', 'min:1', 'max:120'],
        ]);

        // update patient
        $patient->update($validated);

        return redirect()
            ->route('patients.index')
            ->with('success', 'patient updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $patient)
    {
        $patient->delete();
        return redirect()
            ->route('patients.index')
            ->with('success', 'patient deleted successfully!');
    }
}
