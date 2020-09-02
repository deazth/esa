<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('states')->delete();
        
        \DB::table('states')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Wilayah Persekutuan Kuala Lumpur',
                'created_at' => '2020-08-13 04:07:46',
                'updated_at' => '2020-08-13 04:07:46',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Pahang',
                'created_at' => '2020-08-13 04:07:50',
                'updated_at' => '2020-08-13 04:07:50',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Perlis',
                'created_at' => '2020-08-19 04:16:47',
                'updated_at' => '2020-08-19 04:16:47',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Kedah',
                'created_at' => '2020-08-19 04:16:50',
                'updated_at' => '2020-08-19 04:16:50',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Perak',
                'created_at' => '2020-08-19 04:16:52',
                'updated_at' => '2020-08-19 04:16:52',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Kelantan',
                'created_at' => '2020-08-19 04:16:55',
                'updated_at' => '2020-08-19 04:16:55',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Terengganu',
                'created_at' => '2020-08-19 04:17:00',
                'updated_at' => '2020-08-19 04:17:00',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Melaka',
                'created_at' => '2020-08-19 04:17:08',
                'updated_at' => '2020-08-19 04:17:08',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Negeri Sembilan',
                'created_at' => '2020-08-19 04:17:12',
                'updated_at' => '2020-08-19 04:17:12',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Johor',
                'created_at' => '2020-08-19 04:17:14',
                'updated_at' => '2020-08-19 04:17:14',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Sabah',
                'created_at' => '2020-08-19 04:17:21',
                'updated_at' => '2020-08-19 04:17:21',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Sarawak',
                'created_at' => '2020-08-19 04:17:24',
                'updated_at' => '2020-08-19 04:17:24',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Pulau Pinang',
                'created_at' => '2020-08-19 04:20:29',
                'updated_at' => '2020-08-19 04:20:29',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Selangor',
                'created_at' => '2020-08-19 04:20:51',
                'updated_at' => '2020-08-19 04:20:51',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Wilayah Persekutuan Putrajaya',
                'created_at' => '2020-08-19 04:21:22',
                'updated_at' => '2020-08-19 04:21:22',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Wilayah Persekutuan Labuan',
                'created_at' => '2020-08-19 04:21:26',
                'updated_at' => '2020-08-19 04:21:26',
            ),
        ));
        
        
    }
}