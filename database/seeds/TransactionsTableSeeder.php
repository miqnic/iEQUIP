<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_forms')->insert([
            [
                'transaction_id' => 'TC19000017',
                'user_id' => '201701039',
                'start_date' => Carbon::parse('2018-12-12'),
                'due_date' => Carbon::parse('2018-12-12'),
                'start_time' => Carbon::parse('07:30:00'),
                'end_time' => Carbon::parse('11:00:00'),
                'purpose' => 'CLASS',
                'room_number' => '901',
                'submitted_date' => date('Y-m-d H:i:s'),
                'approval' => '1', //approved
                'claimed' => true,
                'returned' => false,
            ],
            [
                'transaction_id' => 'TC19000018',
                'user_id' => '201701039',
                'start_date' => Carbon::parse('2019-01-01'),
                'due_date' => Carbon::parse('2019-12-12'),
                'start_time' => Carbon::parse('07:30:00'),
                'end_time' => Carbon::parse('11:00:00'),
                'purpose' => 'PROJECT',
                'room_number' => '910',
                'submitted_date' => date('Y-m-d H:i:s'),
                'approval' => '-1', //pending
                'claimed' => false,
                'returned' => false,
            ],
            [
                'transaction_id' => 'TC19000019',
                'user_id' => '000000000',
                'start_date' => Carbon::parse('2019-01-29'),
                'due_date' => Carbon::parse('2019-01-31'),
                'start_time' => Carbon::parse('07:30:00'),
                'end_time' => Carbon::parse('11:30:00'),
                'purpose' => 'CLASS',
                'room_number' => '1001',
                'submitted_date' => date('Y-m-d H:i:s'),
                'approval' => '1', //approved
                'claimed' => true,
                'returned' => true,
            ]
            [
                'transaction_id' => 'TC19000019',
                'user_id' => '201701039',
                'start_date' => Carbon::parse('2019-01-01'),
                'due_date' => Carbon::parse('2019-01-01'),
                'start_time' => Carbon::parse('07:30:00'),
                'end_time' => Carbon::parse('11:00:00'),
                'purpose' => 'CLASS',
                'room_number' => '609',
                'submitted_date' => date('Y-m-d H:i:s'),
                'approval' => '1', //approved
                'claiming' => false,
            ],
            [
                'transaction_id' => 'TC19000020',
                'user_id' => '201701039',
                'start_date' => Carbon::parse('2019-01-01'),
                'due_date' => Carbon::parse('2019-01-01'),
                'start_time' => Carbon::parse('07:30:00'),
                'end_time' => Carbon::parse('11:00:00'),
                'purpose' => 'EVENT',
                'room_number' => '1005',
                'submitted_date' => date('Y-m-d H:i:s'),
                'approval' => '0', //pending
                'claiming' => false,
            ]
        ]);
    }
}
