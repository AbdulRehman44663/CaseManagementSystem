<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BkCreditorLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $creditorLocations = [
            [1, 1, '801 Forrest Ave, Gadsden, AL 35901'],
            [1, 1, '100 Northside Square, Huntsville, AL 35801'],
            [1, 1, '2005 University Blvd, Tuscaloosa, AL 35401'],
            [1, 1, '1800 5th Avenue North, Birmingham, AL 35203'],
            [2, 1, '701 Avenue A, Opelika, AL 36801'],
            [2, 1, '100 W. Troy Street,  Dothan, AL 36303'],
            [2, 1, '1 Church Street,  Montgomery, AL 36104'],
            [3, 1, '155 St. Joseph St., Mobile, AL 36602'],
            [3, 1, '908 Alabama Ave., Selma, AL 36701'],
            [4, 2, '605 W 4th Ave, Anchorage, AK 99501'],
            [5, 3, '1440 Desert Hills Dr, Yuma, AZ 85365'],
            [5, 3, '38 S Scott Ave, Tucson, AZ 85701'],
            [5, 3, '230 N. First Ave., Phoenix, Arizona 85003'],
            [5, 3, '971 Jason Lopez Cir, Bldg A, 3rd Floor, Florence AZ 85132'],
            [7, 5, '915 Wilshire Blvd, 10th Floor, Los Angeles CA 90017'],
            [5, 3, '201 S Cortez St, Prescott, AZ 86303'],
            [5, 3, '123 N San Francisco St, Flagstaff, AZ 86001'],
            [5, 3, '2225 Trane Rd., Bullhead City, AZ 86442'],
            [6, 4, '615 S. Main St., Jonesboro, AR72401'],
            [6, 4, '200 W. Capitol, Little Rock, AR 72201'],
            [6, 4, '617 Walnut Street, Helena, AR 72342'],
            [7, 5, '3801 University Avenue, Riverside CA 92501'],
            [7, 5, '21041 Burbank Blvd, Woodland Hills CA 91367'],
            [7, 5, '411 W. Fourth Street, Santa Ana CA 92701'],
            [7, 5, '1415 S. State Street, Santa Barbara CA 93101'],
            [8, 5, '501 I Street, 7th Floor, Room 7-A, Sacramento, CA 95814'],
            [8, 5, '501 I Street, 7th Floor, Room 7-B, Sacramento, CA 95814'],
            [8, 5, '501 I Street, 7th Floor, Room 7-500, Sacramento, CA 95814'],
            [8, 5, '2500 Tulare Street, 1st Floor, Room 1450, Fresno, CA 93721'],
            [8, 5, '2500 Tulare Street, 1st Floor, Room 1452, Fresno, CA 93721'],
            [8, 5, '1200 I Street, Suite 2, 1st Floor, Modesto, CA 95354'],
            [8, 5, '1300 18th Street, Bakersfield, CA 93301'],
            [9, 5, '777 Sonoma Ave, Santa Rosa, CA 95404'],
            [9, 5, '450 Golden Gate Avenue, San Francisco, CA 94102'],
            [9, 5, '1301 Clay Street, Oakland CA 94612'],
            [9, 5, '280 S 1st Street, San Jose CA 95113'],
            [10, 5, '880 Front Street, San Diego, CA 92101']
        ];

        foreach ($creditorLocations as [$districtId, $stateId, $creditorAddress]) {
            DB::table('bk_creditor_locations')->insert([
                'bk_court_state_id'     => $stateId,
                'bk_court_district_id'  => $districtId,
                'bk_creditor_address'   => $creditorAddress,
            ]);
        }
    }
}
