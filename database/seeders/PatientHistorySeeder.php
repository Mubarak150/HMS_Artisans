<?php

namespace Database\Seeders;

use App\Models\PatientHistory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all patients (users with role = patient)
        $patients = User::role('patient')->get();

        // If no patients exist, create some dummy ones
        if ($patients->isEmpty()) {
            $patients = User::factory(10)->create()->each(function ($user) {
                $user->assignRole('patient');
            });
        }

        // Generate 5 history records for each patient
        foreach ($patients as $patient) {
            PatientHistory::factory(5)->create([
                'patient_id' => $patient->id,
            ]);
        }
    }
}
