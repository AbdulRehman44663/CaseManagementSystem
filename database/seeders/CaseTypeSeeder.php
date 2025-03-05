<?php

namespace Database\Seeders;

use App\Models\CaseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CaseType::insert([
            ['name' => 'Bankruptcy', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vehicle Accident', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Divorce', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Child Support/Custody', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Criminal', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'DUI/DWI', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Traffic Tickets', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Expungement', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Workers Comp', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Immigration', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Breach of Contract', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Landlord/Tenant', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Eviction', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Slip & Fall', 'custom' => 'yes', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
