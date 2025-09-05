<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

     // Show the signup  form ::get
    public function signupDoctor()
    {
        return view('dashboard.signup.doctor');
    }

    public function signupPatient()
    {
        return view('dashboard.signup.patient');
    }

    /**
     * Handle an authentication attempt ::post
     */
    public function attemptPatient(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female,other'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
        ]);

        $credentials['password'] = 'password'; // ei am making default password for new users.. user will change it later on first login using forgot password option
 
        if (User::create($credentials)) {
            $request->session()->regenerate();
 
            // return redirect()->intended('dashboard');
            return redirect()->route('dashboard')->with('success', 'Welcome back!');

        }
 
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
        return back()->with('error', 'Invalid email or password.');
    }

    


   
}
