<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'userID' => '000-00001',
            'f_name' => 'System',
            'm_name' => 'Admin',
            'l_name' => 'User',
            'password' => Hash::make('admin123'),
            'email' => 'admin@sesyu.com',
            'gender' => 'M',
            'address' => 'Main Campus',
            'phoneNum' => '09123456789',
            'roleID' => '1',
        ]);

        User::factory(5)->create(['roleID' => '2']); // Employees
        User::factory(10)->create(['roleID' => '3']); // Students
    }
}
