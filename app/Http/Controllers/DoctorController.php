<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = User::role('doctor')->get();
        return view('doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctor.create');
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
        $user->assignRole('doctor');
         // return redirect()->intended('dashboard');
        return redirect()->route('doctors.index')->with('success', 'Registered Successfully!');
        
        // return back()->with('error', 'Invalid credentials.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $doctor)
    {
        return view('doctor.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $doctor)
    {
        return view ('doctor.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $doctor)
    {
        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', 'unique:users,email,' . $doctor->id],
            'gender' => ['required', 'in:male,female,other'],
            'age'    => ['required', 'integer', 'min:1', 'max:120'],
        ]);

        // update doctor
        $doctor->update($validated);

        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $doctor)
    {
        $doctor->delete();
        return redirect()
            ->route('doctors.index')
            ->with('success', 'Doctor deleted successfully!');
    }
}
