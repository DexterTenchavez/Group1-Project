<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Super Admin
        User::updateOrCreate(
            ['email' => 'dexter@gmail.com'],
            [
                'name' => 'Dexter',
                'password' => Hash::make('dexter123'),
                'role' => 'admin',
                'address' => null,
                'motto' => null,
                'age' => null,
                'sex' => null,
                'profile_photo' => null,
                'email_verified_at' => now(),
            ]
        );
        
        $this->command->info('Admin created successfully!');
    }
}