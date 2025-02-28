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

        $admin2 = User::create([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('rahasia')
        ]);

        $admin2->assignRole('admin');

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('rahasia')
        ]);

        $user->assignRole('user');
    }
}
