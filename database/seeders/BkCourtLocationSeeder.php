<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BkCourtLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courtLocations = [
            [1, 1, '1129 Noble Street, Anniston, Alabama 36201'],
            [1, 1, '400 Well Street, Decatur, Alabama 35601'],
            [1, 1, '210 N Seminary St, 2nd Floor, Florence, AL 35630'],
            [1, 1, '101 Holmes Avenue, Huntsville, AL 35801'],
            [1, 1, '1800 Fifth Avenue North, Birmingham, Alabama 35203'],
            [1, 1, '2005 University Boulevard, Tuscaloosa, Alabama 35401'],
            [2, 1, '1 Church Street, Montgomery, AL 36104'],
            [2, 1, '701 Avenue A, Opelika, AL 36801'],
            [2, 1, '100 W. Troy Street, Dothan, AL 36303'],
            [3, 1, '113 St Joseph Street, Mobile, AL 36602'],
            [3, 1, '908 Alabama Ave, Selma AL 36701'],
            [4, 2, '605 W. 4th Ave, Anchorage, AK 99501'],
            [4, 2, '101 12th Ave, Fairbanks, AK 99701'],
            [4, 2, 'Juneau'],
            [5, 3, '230 N 1st Ave, Phoenix, AZ 85003'],
            [5, 3, '38 S Scott Ave, Tucson, AZ 85701'],
            [5, 3, '98 W 1st Street, Yuma, AZ 85364'],
            [5, 3, '123 N San Francisco Street, Flagstaff, AZ 86001'],
            [5, 3, '2225 Trane Road, Bullhead City, AZ 86442'],
            [6, 4, '300 W. 2nd Street, Little Rock, AR 72201'],
            [6, 4, '35 E. Mountain Street, Room 316, Fayetteville, AR 72701'],
            [7, 5, '255 E. Temple Street, Los Angeles CA 90012'],
            [7, 5, '3420 Twelfth Street, Riverside, CA 92501'],
            [7, 5, '411 West Fourth Street, Santa Ana CA 92701'],
            [7, 5, '21041 Burbank Boulevard, Woodland Hills CA 91367'],
            [7, 5, '1415 State Street, Santa Barbara CA 93101'],
            [8, 5, '501 I Street, Sacramento, CA 95814'],
            [8, 5, '2500 Tulare Street, Fresno, CA 93721'],
            [8, 5, '1200 I Street, Modesto, CA 95354'],
            [8, 5, '510 19th Street, Bakersfield, CA 93301'],
            [9, 5, '1300 Clay Street, Oakland CA 94612'],
            [9, 5, '280 South First Street, San Jose CA 95113'],
            [9, 5, '99 South E Street, Santa Rosa CA 95404'],
            [9, 5, '450 Golden Gate Ave, San Francisco CA 94102'],
            [10, 5, '325 West F Street, San Diego CA 92101'],
        ];

        foreach ($courtLocations as [$districtId, $stateId, $courtAddress]) {
            DB::table('bk_court_locations')->insert([
                'bk_court_state_id'    => $stateId,
                'bk_court_district_id' => $districtId,
                'bk_court_address'     => $courtAddress,
            ]);
        }

    }
}
