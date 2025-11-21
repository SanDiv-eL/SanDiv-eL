<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Diva Arviansyah',
            'email' => 'admin@ex.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
    }
}
