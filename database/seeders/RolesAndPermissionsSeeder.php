<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminRole = Role::create(['name' => 'admin']);
        $doctorRole = Role::create(['name' => 'doctor']);
        $patientRole = Role::create(['name' => 'patient']);
    }
}
