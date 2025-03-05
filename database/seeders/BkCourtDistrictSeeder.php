<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BkCourtDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            [1, 'Northern District of Alabama'],
            [1, 'Middle District of Alabama'],
            [1, 'Southern District of Alabama'],
            [2, 'District of Alaska'],
            [3, 'District of Arizona'],
            [4, 'Eastern and Western District Arkansas'],
            [5, 'Central District of California'],
            [5, 'Eastern District of California'],
            [5, 'Northern District of California'],
            [5, 'Southern District of California'],
            [6, 'District of Colorado'],
            [7, 'District of Connecticut'],
            [8, 'District of Delaware'],
            [9, 'Middle District of Florida'],
            [9, 'Northern District of Florida'],
            [9, 'Southern District of Florida'],
            [10, 'Middle District of Georgia'],
            [10, 'Northern District of Georgia'],
            [10, 'Southern District of Georgia'],
            [11, 'District of Hawaii'],
            [12, 'District of Idaho'],
            [13, 'Central District of Illinois'],
            [13, 'Northern District of Illinois'],
            [13, 'Southern District of Illinois'],
            [14, 'Northern District of Indiana'],
            [14, 'Southern District of Indiana'],
            [15, 'Northern District of Iowa'],
            [15, 'Southern District of Iowa'],
            [16, 'District of Kansas'],
            [17, 'Eastern District of Kentucky'],
            [17, 'Western District of Kentucky'],
            [18, 'Eastern District of Louisiana'],
            [18, 'Western District of Louisiana'],
            [18, 'Middle District of Louisiana'],
            [19, 'District of Maine'],
            [20, 'District of Maryland'],
            [21, 'District of Massachusetts'],
            [22, 'Eastern District of Michigan'],
            [22, 'Western District of Michigan'],
            [23, 'District of Minnesota'],
            [24, 'Northern District of Mississippi'],
            [24, 'Southern District of Mississippi'],
            [25, 'Eastern District of Missouri'],
            [25, 'Western District of Missouri'],
            [26, 'District of Montana'],
            [27, 'District of Nebraska'],
            [28, 'District of Nevada'],
            [29, 'District of New Hampshire'],
            [30, 'District of New Jersey'],
            [31, 'District of New Mexico'],
            [32, 'Western District of New York'],
            [32, 'Eastern District of New York'],
            [32, 'Southern District of New York'],
            [32, 'Northern District of New York'],
            [33, 'Western District of North Carolina'],
            [33, 'Eastern District of North Carolina'],
            [33, 'Middle District of North Carolina'],
            [34, 'District of North Dakota'],
            [35, 'Southern District of Ohio'],
            [35, 'Northern District of Ohio'],
            [36, 'Eastern District of Oklahoma'],
            [36, 'Northern District of Oklahoma'],
            [36, 'Western District of Oklahoma'],
            [37, 'District of Oregon'],
            [38, 'Eastern District of Pennsylvania'],
            [38, 'Middle District of Pennsylvania'],
            [38, 'Western District of Pennsylvania'],
            [39, 'District of Rhode Island'],
            [40, 'District of South Carolina'],
            [41, 'District of South Dakota'],
            [42, 'Eastern District of Tennessee'],
            [42, 'Middle District of Tennessee'],
            [42, 'Western District of Tennessee'],
            [43, 'Western District of Texas'],
            [43, 'Eastern District of Texas'],
            [43, 'Southern District of Texas'],
            [43, 'Northern District of Texas'],
            [44, 'District of Utah'],
            [45, 'District of Vermont'],
            [46, 'Western District of Virginia'],
            [46, 'Eastern District of Virginia'],
            [47, 'Western District of Washington'],
            [47, 'Eastern District of Washington'],
            [48, 'Southern District of West Virginia'],
            [48, 'Northern District of West Virginia'],
            [49, 'Eastern District of Wisconsin'],
            [49, 'Western District of Wisconsin'],
            [50, 'District of Wyoming'],
            [51, 'District of Puerto Rico']
        ];

        foreach ($districts as [$stateId, $districtName]) {
            DB::table('bk_court_districts')->insert([
                'bk_court_state_id' => $stateId,
                'bk_district_name' => $districtName
            ]);
        }
    }
}
