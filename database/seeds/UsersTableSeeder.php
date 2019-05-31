<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
                'user_img' => 'defaultuser.png',
                'access_role' => 'STUDENT',
                'course' => 'BSCS-SE',
                'email' => '201701039@iacademy.edu.ph',
                'penalty' => '0',
                'password' => bcrypt('pinoynumbahwan'),
                'created_at' => Carbon::now()->subMonths(1)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'first_name' => 'Nicole Kaye',
                'last_name' => 'Bilon',
                'user_id' => '201702012',
                'user_img' => 'defaultuser.png',
                'access_role' => 'STUDENT',
                'course' => 'BSCS-SE',
                'email' => '201702012@iacademy.edu.ph',
                'penalty' => '0',
                'password' => bcrypt('nicolekaye'),
                'created_at' => Carbon::now()->subMonths(1)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'first_name' => 'Miqaela Nicole',
                'last_name' => 'Banguilan',
                'user_id' => '201701051',
                'user_img' => 'defaultuser.png',
                'access_role' => 'STUDENT',
                'course' => 'BSCS-SE',
                'email' => '201701051@iacademy.edu.ph',
                'penalty' => '5000',
                'password' => bcrypt('megbanguilan'),
                'created_at' => Carbon::now()->subMonths(1)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'first_name' => 'iACADEMY',
                'last_name' => 'Admin',
                'access_role' => 'ADMIN',
                'course' => 'Admin',
                'penalty' => '0',
                'user_img' => 'defaultuser.png',
                'user_id' => '000000000',
                'email' => 'admin@iacademy.edu.ph',
                'password' => bcrypt('adminpswrd'),
                'created_at' => Carbon::now()->subMonths(1)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
