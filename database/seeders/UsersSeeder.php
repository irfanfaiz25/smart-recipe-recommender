<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('rahasia')
        ]);

        $admin->assignRole('admin');

        $creators = User::create([
            'name' => 'creators',
            'email' => 'creators@gmail.com',
            'password' => Hash::make('rahasia')
        ]);

        $creators->creators()->create([
            'phone_number' => '081234567890',
            'city' => 'Jakarta'
        ]);

        $creators->assignRole('creators');

        $creators2 = User::create([
            'name' => 'creators 2',
            'email' => 'creators2@gmail.com',
            'password' => Hash::make('rahasia')
        ]);

        $creators2->creators()->create([
            'phone_number' => '081234567870',
            'city' => 'Bandung'
        ]);

        $creators2->assignRole('creators');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('rahasia')
        ]);

        $user->assignRole('user');
    }
}
