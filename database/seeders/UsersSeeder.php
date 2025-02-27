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
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'name' => 'admin 2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('rahasia')
        ]);

        User::create([
            'name' => 'admin 3',
            'email' => 'admin3@gmail.com',
            'password' => Hash::make('rahasia')
        ]);
    }
}
