<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FirstAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'first_name' => 'Abo Ali',
            'last_name' => 'Toshka',
            'email' => 'Abo_Ali@gmail.com',
            'password' => Hash::make('147258369'),
            'role' => 'admin',
        ]);
    }
}
