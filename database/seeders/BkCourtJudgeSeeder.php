<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BkCourtJudgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $judges = [
            [1, 1, 'James J. Robinson', '(256) 741-1529'],
            [1, 1, 'Tamara O. Mitchell', '(205) 714-3850'],
            [1, 1, 'Jennifer H. Henderson', '(205) 561-1623'],
            [1, 1, 'Clifton R. Jessup Jr.', '(256) 340-2700'],
            [1, 1, 'D. Sims Crawford', '(205) 714-3880'],
            [2, 1, 'Bess M. Parrish Creswell', '(334) 954-3892'],
            [2, 1, 'William R. Sawyer', '(334) 954-3882'],
            [3, 1, 'Henry Callaway', '(251) 441-5391 ext 65408'],
            [3, 1, 'Jerry Oldshue', '(251) 441-5391 ext 65406'],
            [4, 2, 'Gary Spraker', '(907) 271-2621'],
            [4, 2, 'Frederick P. Corbit', '(907) 271-2621'],
            [5, 3, 'Brenda Moody Whinery', '(502) 202-7988'],
            [5, 3, 'Daniel P. Collins', '(602) 682-4982'],
            [5, 3, 'Edward P. Ballinger Jr.', '(602) 682-4188'],
            [5, 3, 'Madeleine C. Wanslee', '(602) 682-4066'],
            [5, 3, 'Brenda K. Martin', '(602) 682-4168'],
            [5, 3, 'Paul Sala', '(602) 682-4168'],
            [5, 3, 'Scott H. Gan', '(520) 202-7968'],
            [5, 3, 'Redfield T. Baum', NULL],
            [6, 4, 'Phyllis M. Jones', '(501) 918-5642'],
            [6, 4, 'Richard D. Taylor', '(501) 918-5620'],
            [6, 4, 'Bianca M. Rucker', '(479) 582-9810'],
            [7, 5, 'Alan M. Ahart', '(818) 587-2853'],
            [7, 5, 'Theodor C. Albert', '(714) 338-5304'],
            [7, 5, 'Martin R. Barash', '(818) 587-2821'],
            [7, 5, 'Neil W. Bason', '(213) 894-4085'],
            [7, 5, 'Sheri Bluebond', '(213) 894-3688'],
            [7, 5, 'Julia W. Brand', '(213) 894-7341'],
            [7, 5, 'Scott Clarkson', '(714) 338-5378'],
            [7, 5, 'Thomas B. Donovan', '(213) 894-3728'],
            [7, 5, 'Mark D. Houle', '(951) 774-1085'],
            [7, 5, 'Wayne Johnson', '(951) 774-1098'],
            [7, 5, 'Victoria Kaufman', '(818) 587-2850'],
            [7, 5, 'Sandra Klein', '(213) 894-5856'],
            [7, 5, 'Robert Kwan', '(213) 894-3385'],
            [7, 5, 'Ernest Robles', '(213) 894-4843'],
            [7, 5, 'Barry Russell', '(213) 894-3687'],
            [7, 5, 'Deborah Saltzman', '(213) 894-0995'],
            [7, 5, 'Erithe Smith', '(714) 338-5360'],
            [7, 5, 'Maureen Tighe', '(818) 587-2832'],
            [7, 5, 'Mark Wallace', '(714) 338-5372'],
            [7, 5, 'Scott Yun', ' (951) 774-1075'],
            [7, 5, 'Gregg W. Zive', '(213) 894-6172'],
            [7, 5, 'Vincent P. Zurzolo', '(213) 894-5855'],
            [7, 5, 'Geraldine Mund', '(818) 587-2832'],
            [8, 5, 'Ronald H. Sargis', '(916) 930-4580 '],
            [8, 5, 'Frederick E. Clement', '(916) 930-4411 '],
            [8, 5, 'Christopher D. Jaime', '(916) 930-4421 '],
            [8, 5, 'Rene Lastreto II', '(559) 499-5879'],
            [8, 5, 'Jennifer E. Niemann', '(559) 499-5868'],
            [8, 5, 'Chistopher Klein', '(916) 930-4473 '],
            [9, 5, 'Charles Novack', '(334) 737-6311'],
            [9, 5, 'Hannah L. Blumenstiel', '(334) 737-6311'],
            [9, 5, 'Roger L. Efremsky', '(334) 737-6311'],
            [9, 5, 'M. Elaine Hammond', '(334) 737-6311'],
            [9, 5, 'Stephen L. Johnson', '(334) 737-6311'],
            [9, 5, 'William Lafferty', '(334) 737-6311'],
            [9, 5, 'Dennis Montali', '(334) 737-6311'],
            [10, 5, 'Louise D. Adler', '(619) 557-6594'],
            [10, 5, 'Christopher B. Latham', '(619) 557-6019'],
            [10, 5, 'Margaret M. Mann', '(619) 557-7407'],
            [10, 5, 'Laura S. Taylor', '(619) 557-5157']
        ];

        foreach ($judges as [$districtId, $stateId, $judgeName, $judgeTel]) {
            DB::table('bk_court_judges')->insert([
                'bk_court_state_id'    => $stateId,
                'bk_court_district_id' => $districtId,
                'bk_judge_name'        => $judgeName,
                'bk_judge_tel'         => $judgeTel,
            ]);
        }
    }
}
