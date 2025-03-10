<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenaralCourtCountryOtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courtCountryOther = [
            
            [1, "Aratauga"],
            [1, "Baldwin"],
            [1, "Barbour"],
            [1, "Bibb"],
            [1, "Blount"],
            [1, "Bullock"],
            [1, "Butler"],
            [1, "Calhoun"],
            [1, "Chambers"],
            [1, "Cherokee"],
            [1, "Chilton"],
            [1, "Choctaw"],
            [1, "Clarke"],
            [1, "Clay"],
            [1, "Cleburne"],
            [1, "Coffee"],
            [1, "Colbert"],
            [1, "Conecuh"],
            [1, "Coosa"],
            [1, "Covington"],
            [1, "Crenshaw"],
            [1, "Cullmam"],
            [1, "Dale"],
            [1, "Dallas"],
            [1, "DeKalb"],
            [1, "Elmore"],
            [1, "Escambia"],
            [1, "Etowah"],
            [1, "Fayette"],
            [1, "Franklin"],
            [1, "Geneva"],
            [1, "Greene"],
            [1, "Hale"],
            [1, "Henry"],
            [1, "Houston"],
            [1, "Supreme, Civil & Criminal Appeals"],
            [1, "Jackson"],
            [1, "Jefferson"],
            [1, "Lamar"],
            [1, "Lauderdale"],
            [1, "Lawrence"],
            [1, "Lee"],
            [1, "Limestone"],
            [1, "Lowndes"],
            [1, "Macon"],
            [1, "Madison"],
            [1, "Marengo"],
            [1, "Marion"],
            [1, "Marshall"],
            [1, "Mobile"],
            [1, "Monroe"],
            [1, "Montgomery"],
            [1, "Morgan"],
            [1, "Perry"],
            [1, "Pickens"],
            [1, "Pike"],
            [1, "Randolph"],
            [1, "Russell"],
            [1, "St. Clair"],
            [1, "Shelby"],
            [1, "Sumter"],
            [1, "Talladega"],
            [1, "Tallapoosa"],
            [1, "Tuscaloosa"],
            [1, "Walker"],
            [1, "Washington"],
            [1, "Wilcox"],
            [1, "Winston"],
            [2, "Appellate Court"],
            [2, "Angoon"],
            [2, "Haines"],
            [2, "Hoonah"],
            [2, "Juneau"],
            [2, "Kake"],
            [2, "Ketchikan"],
            [2, "Petersburg"],
            [2, "Prince of Wales"],
            [2, "Sitka"],
            [2, "Skagway"],
            [2, "Wrangell"],
            [2, "Yakulat"],
            [2, "Kotzebue"],
            [2, "Nome"],
            [2, "Unalakleet"],
            [2, "Utqiagvik"],
            [2, "Anchorage"],
            [2, "Cordova"],
            [2, "Dillingham"],
            [2, "Glennallen"],
            [2, "Homer"],
            [2, "Kenai"],
            [2, "Kodiak"],
            [2, "Naknek"],
            [2, "Palmer"],
            [2, "Sand Point"],
            [2, "St. Paul Island"],
            [2, "Seward"],
            [2, "Unalaska"],
            [2, "Valdez"],
            [2, "Aniak"],
            [2, "Bethel"],
            [2, "Delta Junction"],
            [2, "Emmonak"],
            [2, "Fairbanks"],
            [2, "Fort Yukon"],
            [2, "Galena"],
            [2, "Hooper Bay"],
            [2, "Nenana"],
            [2, "Tok"],
            [3, "Supreme Court"],
            [3, "Apache"],
            [3, "Cochise"],
            [3, "Coconino"],
            [3, "Gila"],
            [3, "Graham"],
            [3, "Greenlee"],
            [3, "La Paz"],
            [3, "Maricopa"],
            [3, "Mohave"],
            [3, "Navajo"],
            [3, "Pima"],
            [3, "Pinal"],
            [3, "Santa Cruz"],
            [3, "Yavapai"],
            [3, "Yuma"],
            [4, "Arkansas"],
            [4, "Ashley"],
            [4, "Baxter"],
            [4, "Benton"],
            [4, "Boone"],
            [4, "Bradley"],
            [4, "Calhoun"],
            [4, "Carroll"],
            [4, "Chicot"],
            [4, "Clark"],
            [4, "Clay"],
            [4, "Cleburne"],
            [4, "Cleveland"],
            [4, "Columbia"],
            [4, "Conway"],
            [4, "Craighead"],
            [4, "Crawford"],
            [4, "Crittenden"],
            [4, "Cross"],
            [4, "Dallas"],
            [4, "Desha"],
            [4, "Drew"],
            [4, "Faulkner"],
            [4, "Franklin"],
            [4, "Fulton"],
            [4, "Garland"],
            [4, "Grant"],
            [4, "Greene"],
            [4, "Hempstead"],
            [4, "Hot Spring"],
            [4, "Howard"],
            [4, "Independence"],
            [4, "Izard"],
            [4, "Jackson"],
            [4, "Jefferson"],
            [4, "Johnson"],
            [4, "Lafayette"],
            [4, "Lawrence"],
            [4, "Lee"],
            [4, "Lincoln"],
            [4, "Little River"],
            [4, "Logan"],
            [4, "Lonoke"],
            [4, "Madison"],
            [4, "Marion"],
            [4, "Miller"],
            [4, "Mississippi"],
            [4, "Monroe"],
            [4, "Montgomery"],
            [4, "Nevada"],
            [4, "Newton"],
            [4, "Ouachita"],
            [4, "Perry"],
            [4, "Phillips"],
            [4, "Pike"],
            [4, "Poinsett"],
            [4, "Polk"],
            [4, "Pope"],
            [4, "Prairie"],
            [4, "Pulaski"],
            [4, "Randolph"],
            [4, "St. Francis"],
            [4, "Saline"],
            [4, "Scott"],
            [4, "Searcy"],
            [4, "Sebastian"],
            [4, "Sevier"],
            [4, "Sharp"],
            [4, "Stone"],
            [4, "Union"],
            [4, "Van Buren"],
            [4, "Washington"],
            [4, "White"],
            [4, "Woodruff"],
            [4, "Yell"],
            [5, "Alameda"],
            [5, "Alpine"],
            [5, "Amador"],
            [5, "Butte"],
            [5, "Calaveras"],
            [5, "Colusa"],
            [5, "Contra Costa"],
            [5, "Del Norte"],
            [5, "El Dorado"],
            [5, "Fresno"],
            [5, "Glenn"],
            [5, "Humboldt"],
            [5, "Imperial"],
            [5, "Inyo"],
            [5, "Kern"],
            [5, "Kings"],
            [5, "Lake"],
            [5, "Lassen"],
            [5, "Los Angeles"],
            [5, "Madera"],
            [5, "Marin"],
            [5, "Mariposa"],
            [5, "Medocino"],
            [5, "Merced"],
            [5, "Modoc"],
            [5, 'Tuolumne'],
            [5, "Mono"],
            [5, "Monterey"],
            [5, "Napa"],
            [5, "Nevada"],
            [5, "Orange"],
            [5, 'Placer'],
            [5, 'Plumas'],
            [5, 'Riverside'],
            [5, 'Sacramento'],
            [5, 'San Benito'],
            [5, 'Tuolumne'],
            [5, 'San Bernardino'],
            [5, 'San Diego'],
            [5, 'San Francisco'],
            [5, 'San Joaquin'],
            [5, 'San Luis'],
            [5, 'San Mateo'],
            [5, 'Santa Barbara'],
            [5, 'Santa Clara'],
            [5, 'Santa Cruz'],
            [5, 'Shasta'],
            [5, 'Sierra'],
            [5, 'Siskiyou'],
            [5, 'Solano'],
            [5, 'Sonoma'],
            [5, 'Stanislaus'],
            [5, 'Sutter'],
            [5, 'Tehama'],
            [5, 'Trinity'],
            [5, 'Tulare'],
            [5, 'Ventura'],
            [5, 'Yolo'],
            [5, 'Yuba'],
            [6, 'Adams'],
            [6, 'Alamosa'],
            [6, 'Arapahoe'],
            [6, 'Archuleta'],
            [6, 'Baca'],
            [6, 'Bent'],
            [6, 'Boulder'],
            [6, 'Broomfield'],
            [6, 'Chafee'],
            [6, 'Cheyenne'],
            [6, 'Clear Creek'],
            [6, 'Conejos'],
            [6, 'Costilla'],
            [6, 'Crowley'],
            [6, 'Custer'],
            [6, 'Delta'],
            [6, 'Denver'],
            [6, 'Dolores'],
            [6, 'Douglas'],
            [6, 'Eagle'],
            [6, 'El Paso'],
            [6, 'Elbert'],
            [6, 'Fremont'],
            [6, 'Garfield'],
            [6, 'Gilpin'],
            [6, 'Grand'],
            [6, 'Gunnison'],
            [6, 'Hinsdale'],
            [6, 'Huerfano'],
            [6, 'Jackson'],
            [6, 'Jefferson'],
            [6, 'Kiowa'],
            [6, 'Kit'],
            [6, 'La Plata'],
            [6, 'Lake'],
            [6, 'Larimer'],
            [6, 'Las Animas'],
            [6, 'Lincoln'],
            [6, 'Logan'],
            [6, 'Mesa'],
            [6, 'Mineral'],
            [6, 'Moffat'],
            [6, 'Montezuma'],
            [6, 'Montrose'],
            [6, 'Morgan'],
            [6, 'Otero'],
            [6, 'Ouray'],
            [6, 'Park'],
            [6, 'Phillips'],
            [6, 'Pitkin'],
            [6, 'Prowers'],
            [6, 'Pueblo'],
            [6, 'Rio Blanco'],
            [6, 'Rio Grande'],
            [6, 'Routt'],
            [6, 'Saguache'],
            [6, 'San Juan'],
            [6, 'San Miguel'],
            [6, 'Segwick'],
            [6, 'Summit'],
            [6, 'Teller'],
            [6, 'Washington'],
            [6, 'Weld'],
            [6, 'Yuma'],
            [7, 'Fairfield'],
            [7, 'Hartford'],
            [7, 'Litchfield'],
            [7, 'Middlesex'],
            [7, 'New Haven'],
            [7, 'New London'],
            [7, 'Tolland'],
            [7, 'Windham'],
            [8, 'Kent'],
            [8, 'New Castle'],
            [8, 'Sussex'],
            [9, 'Alachua'],
            [9, 'Baker'],
            [9, 'Bay'],
            [9, 'Bradford'],
            [9, 'Brevard'],
            [9, 'Broward'],
            [9, 'Calhoun'],
            [9, 'Charlotte'],
            [9, 'Citrus'],
            [9, 'Clay'],
            [9, 'Collier'],
            [9, 'Columbia'],
            [9, 'De Soto'],
            [9, 'Dixie'],
            [9, 'Duval'],
            [9, 'Escambia'],
            [9, 'Flagler'],
            [9, 'Franklin'],  
            [9, 'Gadsden'],  
            [9, 'Gilchrist'],  
            [9, 'Glades'],  
            [9, 'Gulf'],  
            [9, 'Hamilton'],  
            [9, 'Hardee'],  
            [9, 'Hendry'],  
            [9, 'Hernando'],  
            [9, 'Highlands'],  
            [9, 'Hillsborough'],  
            [9, 'Holmes'],  
            [9, 'Indian river'],  
            [9, 'Jackson'],  
            [9, 'Jefferson'],  
            [9, 'Lafayette'],  
            [9, 'Lake'],  
            [9, 'Lee'],  
            [9, 'Leon'],  
            [9, 'Levy'],  
            [9, 'Liberty'],  
            [9, 'Madison'],  
            [9, 'Manatee'],  
            [9, 'Marion'],  
            [9, 'Martin'],  
            [9, 'Miami-Dade'],  
            [9, 'Monroe'],  
            [9, 'Nassau'],  
            [9, 'Okaloosa'],  
            [9, 'Okeechobee'],  
            [9, 'Orange'],  
            [9, 'Osceola'],  
            [9, 'Palm Beach'],  
            [9, 'Pasco'],  
            [9, 'Pinellas'],  
            [9, 'Polk'],  
            [9, 'Putnam'],  
            [9, 'St. Johns'],  
            [9, 'St. Lucie'],  
            [9, 'Santa Rosa'],  
            [9, 'Sarasota'],  
            [9, 'Seminole'],  
            [9, 'Sumter'],  
            [9, 'Suwannee'],  
            [9, 'Taylor'],  
            [9, 'Union'],  
            [9, 'Volusia'],  
            [9, 'Wakulla'],  
            [9, 'Walton'],  
            [9, 'Washington'],  
            [10, 'Appling'],  
            [10, 'Atkinson'],  
            [10, 'Bacon'],  
            [10, 'Baker'],  
            [10, 'Baldwin'],  
            [10, 'Banks'],  
            [10, 'Barrow'],  
            [10, 'Bartow'],  
            [10, 'Ben Hill'],  
            [10, 'Barrien'],  
            [10, 'Bibb'],  
            [10, 'Bleckley'],  
            [10, 'Brantely'],  
            [10, 'Brooks'],  
            [10, 'Bryan'],  
            [10, 'Bulloch'],  
            [10, 'Burke'],  
            [10, 'Butts'],  
            [10, 'Calhoun'],  
            [10, 'Camden'],  
            [10, 'Candler'],  
            [10, 'Carroll'],  
            [10, 'Catoosa'],  
            [10, 'Charlton'],  
            [10, 'Chatham'],  
            [10, 'Chattahoochee'],  
            [10, 'Chattoga'],  
            [10, 'Cherokee'],  
            [10, 'Clarke'],  
            [10, 'Clay'],
            [9, 'Franklin'],
            [9, 'Gadsden'],
            [9, 'Gilchrist'],
            [9, 'Glades'],
            [9, 'Gulf'],
            [9, 'Hamilton'],
            [9, 'Hardee'],
            [9, 'Hendry'],
            [9, 'Hernando'],
            [9, 'Highlands'],
            [9, 'Hillsborough'],
            [9, 'Holmes'],
            [9, 'Indian river'],
            [9, 'Jackson'],
            [9, 'Jefferson'],
            [9, 'Lafayette'],
            [9, 'Lake'],
            [9, 'Lee'],
            [9, 'Leon'],
            [9, 'Levy'],
            [9, 'Liberty'],
            [9, 'Madison'],
            [9, 'Manatee'],
            [9, 'Marion'],
            [9, 'Martin'],
            [9, 'Miami-Dade'],
            [9, 'Monroe'],
            [9, 'Nassau'],
            [9, 'Okaloosa'],
            [9, 'Okeechobee'],
            [9, 'Orange'],
            [9, 'Osceola'],
            [9, 'Palm Beach'],
            [9, 'Pasco'],
            [9, 'Pinellas'],
            [9, 'Polk'],
            [9, 'Putnam'],
            [9, 'St. Johns'],
            [9, 'St. Lucie'],
            [9, 'Santa Rosa'],
            [9, 'Sarasota'],
            [9, 'Seminole'],
            [9, 'Sumter'],
            [9, 'Suwannee'],
            [9, 'Taylor'],
            [9, 'Union'],
            [9, 'Volusia'],
            [9, 'Wakulla'],
            [9, 'Walton'],
            [9, 'Washington'],
            [10, 'Appling'],
            [10, 'Atkinson'],
            [10, 'Bacon'],
            [10, 'Baker'],
            [10, 'Baldwin'],
            [10, 'Banks'],
            [10, 'Barrow'],
            [10, 'Bartow'],
            [10, 'Ben Hill'],
            [10, 'Barrien'],
            [10, 'Bibb'],
            [10, 'Bleckley'],
            [10, 'Brantely'],
            [10, 'Brooks'],
            [10, 'Bryan'],
            [10, 'Bulloch'],
            [10, 'Burke'],
            [10, 'Butts'],
            [10, 'Calhoun'],
            [10, 'Camden'],
            [10, 'Candler'],
            [10, 'Carroll'],
            [10, 'Catoosa'],
            [10, 'Charlton'],
            [10, 'Chatham'],
            [10, 'Chattahoochee'],
            [10, 'Chattoga'],
            [10, 'Cherokee'],
            [10, 'Clarke'],
            [10, 'Clay'],
            [10, 'Clayton'],
            [10, 'Clinch'],
            [10, 'Cobb'],
            [10, 'Coffee'],
            [10, 'Colquitt'],
            [10, 'Columbia'],
            [10, 'Cook'],
            [10, 'Coweta'],
            [10, 'Crawford'],
            [10, 'Crisp'],
            [10, 'Dade'],
            [10, 'Dawson'],
            [10, 'Decatur'],
            [10, 'DeKalb'],
            [10, 'Dodge'],
            [10, 'Dooly'],
            [10, 'Dougherty'],
            [10, 'Douglas'],
            [10, 'Early'],
            [10, 'Echols'],
            [10, 'Effingham'],
            [10, 'Elbert'],
            [10, 'Emanuel'],
            [10, 'Evans'],
            [10, 'Fannin'],
            [10, 'Fayette'],
            [10, 'Floyd'],
            [10, 'Forsyth'],
            [10, 'Franklin'],
            [10, 'Fulton'],
            [10, 'Gilmer'],
            [10, 'Glascosk'],
            [10, 'Glynn'],
            [10, 'Gordon'],
            [10, 'Grady'],
            [10, 'Greene'],
            [10, 'Gwinnett'],
            [10, 'Habersham'],
            [10, 'Hall'],
            [10, 'Hancock'],
            [10, 'Haralson'],
            [10, 'Harris'],
            [10, 'Hart'],
            [10, 'Heard'],
            [10, 'Henry'],
            [10, 'Houston'],
            [10, 'Irwin'],
            [10, 'Jackson'],
            [10, 'Jasper'],
            [10, 'Jeff Davis'],
            [10, 'Jefferson'],
            [10, 'Jenkins'],
            [10, 'Johnson'],
            [10, 'Jones'],
            [10, 'Lamar'],
            [10, 'Lanier'],
            [10, 'Laurens'],
            [10, 'Lee'],
            [10, 'Liberty'],
            [10, 'Lincoln'],
            [10, 'Long'],
            [10, 'Lowndes'],
            [10, 'Lumpkin'],
            [10, 'Macon'],
            [10, 'Madison'],
            [10, 'Marion'],
            [10, 'McDuffie'],
            [10, 'McIntosh'],
            [10, 'Meriwether'],
            [10, 'Miller'],
            [10, 'Mitchell'],
            [10, 'Monroe'],
            [10, 'Montgomery'],
            [10, 'Morgan'],
            [10, 'Murray'],
            [10, 'Muscogee'],
            [10, 'Newton'],
            [10, 'Oconee'],
            [10, 'Oglethorpe'],
            [10, 'Paulding'],
            [10, 'Peach'],
            [10, 'Pickens'],
            [10, 'Pierce'],
            [10, 'Pike'],
            [10, 'Polk'],
            [10, 'Pulaski'],
            [10, 'Putnam'],
            [10, 'Quitman'],
            [10, 'Rabun'],
            [10, 'Randolph'],
            [10, 'Richmond'],
            [10, 'Rockdale'],
            [10, 'Schley'],
            [10, 'Screven'],
            [10, 'Seminole'],
            [10, 'Spalding'],
            [10, 'Stephens'],
            [10, 'Stewart'],
            [10, 'Sumter'],
            [10, 'Talbot'],
            [10, 'Taliaferro'],
            [10, 'Tattnall'],
            [10, 'Taylor'],
            [10, 'Telfair'],
            [10, 'Terrell'],
            [10, 'Thomas'],
            [10, 'Tift'],
            [10, 'Toombs'],
            [10, 'Towns'],
            [10, 'Treutlen'],
            [10, 'Troup'],
            [10, 'Turner'],
            [10, 'Twiggs'],
            [10, 'Union'],
            [10, 'Upson'],
            [10, 'Walker'],
            [10, 'Walton'],
            [10, 'Ware'],
            [10, 'Warren'],
            [10, 'Washington'],
            [10, 'Wayne'],
            [10, 'Webster'],
            [10, 'Wheeler'],
            [10, 'White'],
            [10, 'Whitfield'],
            [10, 'Wilcox'],
            [10, 'Wilkes'],
            [10, 'Wilkinson'],
            [10, 'Worth'],
        ];

        foreach ($courtCountryOther as [$stateId, $courtOther]) {
            DB::table('genaral_court_country_others')->insert([
                'genaral_court_state_id'  => $stateId,
                'general_country_name'    => $courtOther,
            ]);
        }
    }
}
