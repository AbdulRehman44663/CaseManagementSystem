<?php

namespace Database\Seeders;

use App\Models\LawyerAgencyUserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LawyerAgencyUserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LawyerAgencyUserType::insert([
            ['name' => 'Attorney at Law', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Assistant', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Paralegal', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Senior Paralegal', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Supervisor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manager', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Accounting', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
