<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'abu',
                'email' => 'abu@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$1ydoNP6iJ8Gq18FStVqwHeFdLA65XicKyvTAcCK3T8netJrs4qRKu',
                'remember_token' => 'tygDU1rG0Wz7PSIK111ttAOeS021A5kbIcbpYWnN11u1zZadPUSzjC2PjIjK',
                'created_at' => '2020-08-07 04:04:54',
                'updated_at' => '2020-08-07 04:04:54',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'ali',
                'email' => 'ali@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$gHzMcfYUpoSAR75yTl2ICeGCftZc7iNRHDhYvDOD6BAACCjy.oFHe',
                'remember_token' => NULL,
                'created_at' => '2020-08-07 08:06:55',
                'updated_at' => '2020-08-07 08:06:55',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'along',
                'email' => 'along@gmail.com',
                'email_verified_at' => '2020-08-07 08:20:57',
                'password' => '$2y$10$C1z7KvOhBZlq0e5b4BOBr.Nl0tBOEPs1qBMNmPELe6SC3upGwd5Qm',
                'remember_token' => NULL,
                'created_at' => '2020-08-07 08:08:52',
                'updated_at' => '2020-08-07 08:20:57',
            ),
        ));
        
        
    }
}