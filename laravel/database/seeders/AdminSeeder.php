<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::where('email', 'admin@test.com')->first();
        
        if ($admin) {
            $this->command->info('Admin already exists. Skipping creation.');
            return;
        }

        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@test.com',
            'password' => 'admin12345', // Let the model handle hashing
            'first_login' => null,
            'last_login' => null,
        ]);
        
        $this->command->info('Admin created successfully.');
    }
}
