<?php

use Illuminate\Database\Seeder;

class ApplicantGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('applicant_groups')->delete();
        
        \DB::table('applicant_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'B40',
                'created_at' => '2020-08-07 09:22:25',
                'updated_at' => '2020-08-07 09:22:25',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Unemployed Graduates',
                'created_at' => '2020-08-07 09:22:38',
                'updated_at' => '2020-08-07 09:22:38',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'NGO',
                'created_at' => '2020-08-07 09:37:56',
                'updated_at' => '2020-08-07 09:37:56',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Single Parents',
                'created_at' => '2020-08-19 03:55:19',
                'updated_at' => '2020-08-19 03:55:19',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Laid-off Workers',
                'created_at' => '2020-08-19 03:55:30',
                'updated_at' => '2020-08-19 03:55:30',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Ex-uniformed Personnel',
                'created_at' => '2020-08-19 03:55:44',
                'updated_at' => '2020-08-19 03:55:44',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Cooperatives',
                'created_at' => '2020-08-19 03:55:54',
                'updated_at' => '2020-08-19 03:55:54',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'SME in Distress',
                'created_at' => '2020-08-19 03:55:59',
                'updated_at' => '2020-08-19 03:55:59',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Others',
                'created_at' => '2020-08-19 03:56:02',
                'updated_at' => '2020-08-19 03:56:02',
            ),
        ));
        
        
    }
}