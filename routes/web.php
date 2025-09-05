<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientHistoryController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::get('dashboard', function () {
    $totalPatients = User::role('patient')->count();
    $totalDoctors = User::role('doctor')->count();

    // Patients per month
    $patientsRaw = User::role('patient')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->pluck('count', 'month');

    // Doctors per month
    $doctorsRaw = User::role('doctor')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->pluck('count', 'month');

    // Build months and fill missing months with 0
    $months = collect(range(1, 12))->map(fn($m) => date('M', mktime(0, 0, 0, $m, 1)));

    $patientsPerMonth = $months->keys()->mapWithKeys(function ($i) use ($patientsRaw) {
        $monthNumber = $i + 1; // because keys are 0–11
        return [$monthNumber => $patientsRaw[$monthNumber] ?? 0];
    });

    $doctorsPerMonth = $months->keys()->mapWithKeys(function ($i) use ($doctorsRaw) {
        $monthNumber = $i + 1;
        return [$monthNumber => $doctorsRaw[$monthNumber] ?? 0];
    });

    return view('dashboard', compact(
        'totalPatients',
        'totalDoctors',
        'patientsPerMonth',
        'doctorsPerMonth',
        'months'
    ));
})->name('dashboard');

// Route::view('signup', 'signup')->name('signup');

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'attempt'])->name('login.attempt');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('dashboard/register/doctor', [RegisterController::class, 'signupDoctor'])->name('signup.doctor');
Route::get('dashboard/register/patient', [RegisterController::class, 'signupPatient'])->name('signup.patient');
Route::post('signup', [RegisterController::class, 'attempt'])->name('signup.attempt'); //forgotpassword

Route::get("forgotpassword", [LoginController::class, 'forgotpassword'])->name('forgotpassword');
Route::post("forgotpassword", [LoginController::class, 'sendmail'])->name('sendmail');
Route::get('resetpassword', [LoginController::class, 'resetpassword'])->name('resetpassword');
Route::post('resetpassword', [LoginController::class, 'updatepassword'])->name('updatepassword');

Route::resource('doctors', DoctorController::class);
Route::resource('patients', PatientController::class);

Route::get('/patients/{patient}/histories', [PatientHistoryController::class, 'index'])->name('patients.histories.index');
Route::get('/patients/{patient}/histories/{history}', [PatientHistoryController::class, 'show'])->name('patients.histories.show');
Route::get('/patients/{patient}/histories/create', [PatientHistoryController::class, 'create'])->name('patients.histories.create');
Route::post('/patients/{patient}/histories/create', [PatientHistoryController::class, 'store'])->name('patients.histories.store');
Route::get('/patients/{patient}/histories/{history}/edit', [PatientHistoryController::class, 'edit'])->name('patients.histories.edit');
Route::put('/patients/{patient}/histories/{history}', [PatientHistoryController::class, 'update'])->name('patients.histories.update');
Route::delete('/patients/{patient}/histories/{history}', [PatientHistoryController::class, 'destroy'])->name('patients.histories.destroy');
