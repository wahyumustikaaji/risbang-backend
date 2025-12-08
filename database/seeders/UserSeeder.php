<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin Risbang',
            'email' => 'risbang@kemdiktisaintek.go.id',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('r15b4n9_j4y4'),
        ]);
    }
}
