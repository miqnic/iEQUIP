<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carts')->insert([
            [
                'user_id' => '201701039',
                'equipID' => 'CANCAM0003',
                'transaction_id' => 'TC19000018', 
                'equip_name' => 'Canon EOS 80D DSLR Camera',
            ],
            [
                'user_id' => '201701039',
                'equipID' => 'NIKCAM0001',
                'transaction_id' => 'TC19000017', //0=suggestion, 1=complaint, 2=others
                'equip_name' => 'Nikon D3200 DSLR Camera',
            ],
            [
                'user_id' => '201701039',
                'equipID' => 'WACCIN0001',
                'transaction_id' => 'TC19000017', //0=suggestion, 1=complaint, 2=others
                'equip_name' => 'Wacom CINTIQ 13HD Tablet',
            ]
        ]);
    }
}
