<?php

use Illuminate\Database\Seeder;

class EquipmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipment')->insert([
            [
                'equipID' => 'CANCAM0001',
                'equip_name' => 'Canon EOS 80D DSLR Camera',
                'transaction_id' => 'TC19000019',
                'equip_category' => 'CAMACC',
                'equip_avail' => '0', //available
                'equip_description' => '',
                'equip_penalty' => '500',
                'equip_baseprice' => '45990.00',
                'equip_img' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'returned' => true,
            ],
            [
                'equipID' => 'CANCAM0002',
                'equip_name' => 'Canon EOS 80D DSLR Camera',
                'transaction_id' => null,
                'equip_category' => 'CAMACC',
                'equip_avail' => '0', //available
                'equip_description' => '',
                'equip_penalty' => '500',
                'equip_baseprice' => '45990.00',
                'equip_img' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'returned' => false,
            ],
            [

                'equipID' => 'CANCAM0003',
                'equip_name' => 'Canon EOS 80D DSLR Camera',
                'transaction_id' => 'TC19000018',
                'equip_category' => 'CAMACC',
                'equip_avail' => '-1', //unavailable
                'equip_description' => 'Currently Under Maintenance',
                'equip_penalty' => '500',
                'equip_baseprice' => '45990.00',
                'equip_img' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'returned' => false,
            ],
            [

                'equipID' => 'NIKCAM0001',
                'equip_name' => 'Nikon D3200 DSLR Camera',
                'equip_category' => 'CAMACC',
                'transaction_id' => 'TC19000017',
                'equip_avail' => '1', //borrowed
                'equip_description' => '',
                'equip_penalty' => '500',
                'equip_baseprice' => '45990.00',
                'equip_img' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'returned' => false,
            ],
            [

                'equipID' => 'WACCIN0001',
                'equip_name' => 'Wacom CINTIQ 13HD Tablet',
                'equip_category' => 'ART',
                'transaction_id' => 'TC19000017',
                'equip_avail' => '1', //borrowed
                'equip_description' => '',
                'equip_penalty' => '500',
                'equip_baseprice' => '45990.00',
                'equip_img' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'returned' => false,
            ]
        ]);
    }
}
