<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LawyerAgencyUserType;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\LeadStatusSeeder;
use Database\Seeders\ClientStatusSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LawyerAgencyUserTypeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LeadStatusSeeder::class);
        $this->call(ClientStatusSeeder::class);
        $this->call(CaseTypeSeeder::class);
        $this->call(BkCourtStateSeeder::class);
        $this->call(BkCourtDistrictSeeder::class);
        $this->call(BkCourtJudgeSeeder::class);
        $this->call(BkCourtTrusteeSeeder::class);
        $this->call(BkCreditorLocationSeeder::class);
        $this->call(BkCourtLocationSeeder::class);
        $this->call(GenaralCourtStateSeeder::class);
        $this->call(GenaralCourtCountryOtherSeeder::class);
        $this->call(GenaralCourtLocationSeeder::class);
        $this->call(ImmigrationCourtStateSeeder::class);
        $this->call(ImmigrationCourtLocationSeeder::class);
        $this->call(EDocumentVariableSeeder::class);
        $this->call(EmailVariableSeeder::class);
    }
}
