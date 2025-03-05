<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImmigrationCourtLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $immigrationCourtLocations = [
            [1, '1705 E. Hanna Road', 'Eloy, AZ 85131', '(520) 466-3671'],
            [1, '3260 N. Pinal Parkway Avenue', 'Florence, AZ 85132', '(520) 868-3341'],
            [1, '250 N. Seventh Ave', 'Phoenix, AZ 85007', '(602) 640-2747'],
            [1, '300 West Congress', 'Tucson, AZ 85701', '(520) 670-5212'],
            [2, '10250 Rancho Road', 'Adelanto, CA 92301', '(760) 561-6500'],
            [2, '2409 La Brucherie Road', 'Imperial, CA 92251', '(760) 370-5200'],
            [2, '300 N. Los Angeles Street', 'Los Angeles, CA 90012', '(213) 576-4701'],
            [2, '606 S. Olive Street', 'Los Angeles, CA 90014', '(213) 894-2811'],
            [2, '6230 Van Nuys Blvd', 'Van Nuys, CA 91401', '(818) 904-5200'],
            [2, '7488 Calzada de la Fuente', 'San Diego, CA 92154', '(619) 661-5600'],
            [2, '650 Capitol Mall', 'Sacramento, CA 95814', '(916) 447-9301'],
            [2, '880 Front Street', 'San Diego, CA 92101', '(619) 510-4500'],
            [2, '100 Montgomery Street', 'San Francisco, CA 94104', '(415) 705-4415'],
            [2, '630 Sansome Street', 'San Francisco, CA 94111', '(415) 705-1033'],
            [3, '3130 N. Oakland Street', 'Aurora, CO 80010', '(303) 361-0488'],
            [3, '1961 Stout Street', 'Denver, CO 80294', '(303) 844-5815'],
            [4, '450 Main Street', 'Hartford, CT 06103', '(860) 240-3881'],
            [5, '333 S. Miami Avenue', 'Miami, FL 33130', '(305) 789-4221'],
            [5, '18201 SW 12th Street', 'Miami, FL 33194', '(786) 422-8700'],
            [5, '3535 Lawton Road', 'Orlando, FL 32803', '(407) 722-8900'],
            [6, '180 Ted Turner Drive, SW', 'Atlanta, GA 30303', '(404) 331-0907'],
            [6, '401 W. Peachtree Street', 'Atlanta, GA 30308', '(404) 554-9400'],
            [6, '146 CCA Road', 'Lumpkin, GA 31815', '(229) 838-1320'],
            [7, '300 Ala Moana Blvd', 'Honolulu, HI 96850', '(808) 541-1870'],
            [8, '525 West Van Buren Street', 'Chicago, IL 60607', '(312) 697-5800'],
            [8, '536 S. Clark Street', 'Chicago, IL 60605', '(312) 294-8400'],
            [9, '332 W Broadway', 'Louisville, KY 40202', '(502) 340-2000'],
            [10, '830 Pine Hill Road', 'Jena, LA, 71342', '(318) 335-6880'],
            [10, '365 Canal Street', 'New Orleans, LA 70130', '(504) 589-3992'],
            [10, '1900 E. Whatley Road', 'Oakdale, LA 71463', '(318) 335-0365'],
            [11, '31 Hopkins Plaza', 'Baltimore, MD 21201', '(410) 962-3092'],
            [12, '15 New Sudbury Street', 'Boston, MA 02203', '(617) 565-3080'],
            [13, '477 Michigan Avenue', 'Detroit, MI 48226', '(313) 226-2603'],
            [14, '1 Federal Drive', 'Fort Snelling, MN 55111', '(612) 725-3765'],
            [15, '2345 Grand Boulevard', 'Kansas City, MO 64108', '(816) 581-5000'],
            [16, '1717 Avenue H', 'Omaha, NE 68110', '(402) 348-0310'],
            [17, '110 North City Parkway', 'Las Vegas, NV 89106', '(702) 458-0227'],
            [18, '625 Evans Street', 'Elizabeth, NJ 07201', '(908) 787-1355'],
            [18, '970 Broad Street', 'Newark, NJ 07102', '(973) 645-3524'],
            [19, '26 McGregor Range Rd', 'Chaparral, NM 88081', '(575) 824-8900'],
            [20, '4250 Federal Drive', 'Batavia, NY 14020', '(585) 345-4300'],
            [20, '130 Delaware Avenue', 'Buffalo, NY 14202', '(716) 551-3442'],
            [20, '121 Red Schoolhouse Road', 'Fishkill, NY 12524', '(845) 838-5700'],
            [20, '290 Broadway', 'New York, NY 10007', '(212) 240-4900'],
            [20, '26 Federal Plaza', 'New York, NY 10278', '(917) 454-1040'],
            [20, 'Berme Road', 'Napanoch, NY 12458', '(845) 647-2223'],
            [20, '201 Varick Street', 'New York, NY 10014', '(646) 638-5766'],
            [21, '5701 Executive Center Drive', 'Charlotte, NC 28212', '(704) 817-6140'],
            [22, '801 W. Superior Avenue', 'Cleveland, OH 44113', '(216) 802-1100'],
            [23, '1220 SW 3rd Avenue', 'Portland, OR 97204', '(503) 326-6341'],
            [24, '900 Market Street', 'Philadelphia, PA 19107', '(215) 656-7000'],
            [24, '3400 Concord Road', 'York, PA 17402', '(717) 755-7555'],
            [25, '80 Monroe Ave', 'Memphis, TN 38103', '(901) 528-5883'],
            [26, '806 Hilbig Road', 'Conroe, TX 77301', '(936) 520-5400'],
            [26, '1100 Commerce Street', 'Dallas, TX 75242', '(214) 767-1814'],
            [26, '700 E. San Antonio Avenue', 'El Paso, TX 79901', '(915) 534-6020'],
            [26, '8915 Montana Avenue', 'El Paso, TX 79925', '(915) 771-1600'],
            [26, '819 Taylor Street', 'Fort Worth, TX 76102', '(817) 333-0500'],
            [26, '2009 West Jefferson Avenue', 'Harlingen, TX 78550', '(956) 427-8580'],
            [26, '1801 Smith Street', 'Houston, TX 77002', '(713) 718-3870'],
            [26, '1919 Smith Street', 'Houston, TX 77002', '(713) 751-1514'],
            [26, '16800 Greenspoint Park Drive', 'Houston, TX 77060', '(281) 765-5900'],
            [26, '8701 S. Gessner Road', 'Houston, TX 77074', '(713) 995-3900'],
            [26, '566 Veterans Drive', 'Pearsall, TX 78061', '(210) 368-5700'],
            [26, '27991 Buena Vista Blvd', 'Los Fresnos, TX 78566', '(956) 254-5700'],
            [26, '800 Dolorosa Street', 'San Antonio, TX 78207', '(210) 472-6637'],
            [26, '106 S. St. Mary\'s Street', 'San Antonio, TX 78205', '(210) 230-9505'],
            [27, '2975 South Decker Lake Drive', 'West Valley City, UT 84119', '(801) 524-3000'],
            [28, '1901 South Bell Street', 'Arlington, VA 22202', '(703) 603-1300'],
            [28, '5107 Leesburg Pike', 'Falls Church, VA 22041', '(703) 756-8002'],
            [28, '10 S. 6th Street', 'Richmond, VA 23219', '(804) 343-2900'],
            [29, '915 2nd Ave', 'Seattle, WA 98174', '(206) 342-7200'],
            [29, '1623 East J Street', 'Tacoma, WA 98421', '(253) 779-6020'],
            [30, 'Marina Heights Business Park', 'Saipan, MP 96950', '(670) 322-0601'],
            [31, '7 Tabonuco Street', 'Guaynabo, PR 00968', '(787) 749-4386'],
            
        ];

        foreach ($immigrationCourtLocations as [$stateId, $courtAddress, $courtCityStateZip, $courtPhone]) {
            DB::table('immigration_court_locations')->insert([
                'immigration_court_state_id'        => $stateId,
                'immigration_court_address'         => $courtAddress,
                'immigration_court_city_state_zip'  => $courtCityStateZip,
                'immigration_court_phone'           => $courtPhone,
            ]);
        }
    }
}
