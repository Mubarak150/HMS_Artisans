<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

     // Show the login form ::get
    public function login()
    {
        return view('login');
    }

    /**
     * Handle an authentication attempt ::post
     */
    public function attempt(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Welcome back!');
        }
        return back()->with('error', 'Invalid email or password.');
    }

    // Handle logout ::get
    public function logout(Request $request): RedirectResponse {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'You have been logged out.');     
    }

    public function forgotpassword() {
        return view("forgotpassword");
    }

    public function sendmail(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'This email is not registered with us.',
        ]);


        if ($validator->fails()) {
            // redirect back with input + error for your toaster
            return back()
                ->withInput()
                ->with('error', $validator->errors()->first('email'));
        }

        // 
        $token = Str::random(60);

        // 
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now(),
            ]
        );

        //
        Mail::raw('Click here to reset your password: ' . url('/resetpassword?token=' . $token . '&email=' . urlencode($request->email)), function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset Request');
        });

        return back()->with('success', 'Done! see your gmail for password reset link .');
    }

    public function resetpassword(Request $request){
        $email = $request->query('email'); 
        $token = $request->query('token');
        
        $record = DB::table('password_reset_tokens')->where([
            ['email', $email],
            ['token', $token], 
        ])->first();

        if (!$record) {
            return redirect('/login')->with('error', 'Invalid or expired password reset token.');
        }

        return view('resetpassword', ['email' => $email, 'token' => $token]);
    }

    public function updatepassword(Request $request): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
            'token' => ['required'],
            'password' => ['required', 'confirmed', 'min:6'],
        ], [
            'email.exists' => 'This email is not registered with us.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withInput()
                ->with('error', $validator->errors()->first());
        }

        $record = DB::table('password_reset_tokens')->where([
            ['email', $request->email],
            ['token', $request->token],
        ])->first();

        if (!$record) {
            return redirect('/login')->with('error', 'Invalid or expired password reset token.');
        }

        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect('/login')->with('success', 'Your password has been reset successfully. You can now log in with your new password.');
    }
}


