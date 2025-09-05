<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'doctor', 'patient'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Create 10 fake users with random roles
        User::factory(10)->create()->each(function ($user) use ($roles) {
            $randomRole = collect($roles)->random(); // pick one role randomly
            $user->assignRole($randomRole);
        });
        
        //  User::create([
        //     'name' => 'Muhammad Mubarak',
        //     'email' => 'mkmubarak2347@gmail.com',
        //     'password' => Hash::make('user2347'), // never store plain passwords
        // ])->assignRole('admin');

        
    }
}
