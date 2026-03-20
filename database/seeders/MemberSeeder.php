<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    public function run()
    {
        // Dexter Tenchavez
        User::updateOrCreate(
            ['email' => 'dextertenchavez@gmail.com'],
            [
                'name' => 'Dexter Tenchavez',
                'password' => Hash::make('dexter123'),
                'role' => 'member',
                'address' => null,
                'motto' => null,
                'age' => null,
                'sex' => null,
                'profile_photo' => null,
                'email_verified_at' => now(),
            ]
        );

        // Niño Labos
        User::updateOrCreate(
            ['email' => 'ninolabos@gmail.com'],
            [
                'name' => 'Niño Labos',
                'password' => Hash::make('nino1234'),
                'role' => 'member',
                'address' => null,
                'motto' => null,
                'age' => null,
                'sex' => null,
                'profile_photo' => null,
                'email_verified_at' => now(),
            ]
        );

        // Kent Joseph Mabanag
        User::updateOrCreate(
            ['email' => 'kentjosephmabanag@gmail.com'],
            [
                'name' => 'Kent Joseph Mabanag',
                'password' => Hash::make('kentjoseph123'),
                'role' => 'member',
                'address' => null,
                'motto' => null,
                'age' => null,
                'sex' => null,
                'profile_photo' => null,
                'email_verified_at' => now(),
            ]
        );

        // Kenneth Baculpo
        User::updateOrCreate(
            ['email' => 'kennethbaculpo@gmail.com'],
            [
                'name' => 'Kenneth Baculpo',
                'password' => Hash::make('kentoy123'),
                'role' => 'member',
                'address' => null,
                'motto' => null,
                'age' => null,
                'sex' => null,
                'profile_photo' => null,
                'email_verified_at' => now(),
            ]
        );
        
        // Jerome Ayanan
        User::updateOrCreate(
            ['email' => 'jeromeayanan@gmail.com'],
            [
                'name' => 'Jerome Ayanan',
                'password' => Hash::make('jerome123'),
                'role' => 'member',
                'address' => 'taga candijay, bohol',
                'motto' => 'Eyes searching. Heart hoping. Always for you',
                'age' => 22,
                'sex' => 'male',
                'profile_photo' => null,
                'email_verified_at' => now(),
            ]
        );
        
        $this->command->info('Members created successfully!');
    }
}