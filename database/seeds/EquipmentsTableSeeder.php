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
                'equip_id' => 'CANCAM0001',
                'equip_name' => 'Canon EOS 80D DSLR Camera',
                'transaction_id' => null,
                'equip_category' => 'CAMACC',
                'equip_avail' => '0', //available
                'equip_description' => '',
                'equip_penalty' => '500',
                'equip_img' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'returned' => false,
            ],
            [
                'equip_id' => 'CANCAM0002',
                'equip_name' => 'Canon EOS 80D DSLR Camera',
                'transaction_id' => null,
                'equip_category' => 'CAMACC',
                'equip_avail' => '-1',
                'equip_description' => 'Currently Under Maintenance',
                'equip_penalty' => '500',
                'equip_img' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'returned' => false,
            ],
            [
                'equip_id' => 'NIKCAM0001',
                'equip_name' => 'Nikon D3200 DSLR Camera',
                'equip_category' => 'CAMACC',
                'transaction_id' => 'TC19000017',
                'equip_avail' => '1', //borrowed
                'equip_description' => '',
                'equip_penalty' => '500',
                'equip_img' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'returned' => false,
            ]
        ]);
    }
}
