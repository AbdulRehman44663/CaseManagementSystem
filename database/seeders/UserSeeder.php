<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LawyerAgencyUserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = LawyerAgencyUserType::first();
        
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@CaseManagementSystem.com',
            'password' => Hash::make('12345678'),
            'is_administrator' => 'yes',
            'user_type' => $user->id,
            'status' => 'active',
        ]);
    }
}
