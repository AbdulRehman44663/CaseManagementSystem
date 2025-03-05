<?php

namespace Database\Seeders;

use App\Models\LeadStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeadStatus::insert([
            ['name' => 'New Lead', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Contact Made', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Follow-up', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Consult Scheduled', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'No Show', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dead Deal', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
