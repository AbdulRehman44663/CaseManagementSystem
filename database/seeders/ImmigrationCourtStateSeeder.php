<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImmigrationCourtStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $immigrationStates = [
            'Arizona',
            'California',
            'Colorado',
            'Connecticut',
            'Florida',
            'Georgia',
            'Hawaii',
            'Illinois',
            'Kentucky',
            'Louisiana',
            'Maryland',
            'Massachusetts',
            'Michigan',
            'Minnesota',
            'Missouri',
            'Nebraska',
            'Nevada',
            'New Jersey',
            'New Mexico',
            'New York',
            'North Carolina',
            'Ohio',
            'Oregon',
            'Pennsylvania',
            'Tennessee',
            'Texas',
            'Utah',
            'Puerto Rico',
            'Virginia',
            'Washington',
            'Northern Mariana Islands',
        ];
        
        foreach ($immigrationStates as $state) {
            DB::table('immigration_court_states')->insert([
                'immigration_state_name' => $state,
            ]);
        }
    }
}
