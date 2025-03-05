<?php

namespace Database\Seeders;

use App\Models\ClientStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientStatus::insert([
            ['name' => 'Intro', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ready', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Filed', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Discharged', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dismissed', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Closed-Full Refund', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Closed-Partial Refund', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Closed-No Refund', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
