<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseSeeder extends Seeder
{
    private const HOUSES = [
        [
            'name' => 'The Victoria',
            'price' => 374662,
            'count_bedrooms' => 4,
            'count_bathrooms' => 2,
            'count_storeys' => 2,
            'count_garages' => 2,
        ],
        [
            'name' => 'The Xavier',
            'price' => 513268,
            'count_bedrooms' => 4,
            'count_bathrooms' => 2,
            'count_storeys' => 1,
            'count_garages' => 2,
        ],
        [
            'name' => 'The Como',
            'price' => 454990,
            'count_bedrooms' => 4,
            'count_bathrooms' => 3,
            'count_storeys' => 2,
            'count_garages' => 3,
        ],
        [
            'name' => 'The Aspen',
            'price' => 384356,
            'count_bedrooms' => 4,
            'count_bathrooms' => 2,
            'count_storeys' => 2,
            'count_garages' => 2,
        ],
        [
            'name' => 'The Lucretia',
            'price' => 572002,
            'count_bedrooms' => 4,
            'count_bathrooms' => 3,
            'count_storeys' => 2,
            'count_garages' => 2,
        ],
        [
            'name' => 'The Toorak',
            'price' => 521951,
            'count_bedrooms' => 5,
            'count_bathrooms' => 2,
            'count_storeys' => 1,
            'count_garages' => 2,
        ],
        [
            'name' => 'The Skyscape',
            'price' => 263604,
            'count_bedrooms' => 3,
            'count_bathrooms' => 2,
            'count_storeys' => 2,
            'count_garages' => 2,
        ],
        [
            'name' => 'The Clifton',
            'price' => 386103,
            'count_bedrooms' => 3,
            'count_bathrooms' => 2,
            'count_storeys' => 1,
            'count_garages' => 1,
        ],
        [
            'name' => 'The Geneva',
            'price' => 390600,
            'count_bedrooms' => 4,
            'count_bathrooms' => 3,
            'count_storeys' => 2,
            'count_garages' => 2,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::HOUSES as $parameters) {
            DB::table('houses')->insert(
                [
                    'name' => $parameters['name'],
                    'price' => $parameters['price'],
                    'count_bedrooms' => $parameters['count_bedrooms'],
                    'count_bathrooms' => $parameters['count_bathrooms'],
                    'count_storeys' => $parameters['count_storeys'],
                    'count_garages' => $parameters['count_garages'],
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            );
        }
    }
}
