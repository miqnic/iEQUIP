<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Rhej Christian',
                'last_name' => 'Laurel',
                'user_id' => '201701039',
                'user_img' => '',
                'access_role' => 'STUDENT',
                'course' => 'BSCS-SE',
                'email' => '201701039@iacademy.edu.ph',
                'penalty' => '0',
                'password' => bcrypt('pinoynumbahwan'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'first_name' => 'Nicole Kaye',
                'last_name' => 'Bilon',
                'user_id' => '201702021',
                'user_img' => '',
                'access_role' => 'STUDENT',
                'course' => 'BSCS-SE',
                'email' => '201702021@iacademy.edu.ph',
                'penalty' => '0',
                'password' => bcrypt('nicolekaye'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'first_name' => 'Meg',
                'last_name' => 'Banguilan',
                'user_id' => '201701051',
                'user_img' => '',
                'access_role' => 'STUDENT',
                'course' => 'BSCS-SE',
                'email' => '201701051@iacademy.edu.ph',
                'penalty' => '5000',
                'password' => bcrypt('megbanguilan'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'first_name' => 'iACADEMY',
                'last_name' => 'Admin',
                'access_role' => 'ADMIN',
                'course' => 'Admin',
                'penalty' => '0',
                'user_img' => '',
                'user_id' => '000000000',
                'email' => 'admin@iacademy.edu.ph',
                'password' => bcrypt('adminpswrd'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
