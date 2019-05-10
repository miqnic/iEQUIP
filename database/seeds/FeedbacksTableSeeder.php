<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FeedbacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feedbacks')->insert([
            [
                'user_id' => '201701039',
                'subject' => 'Damaged Camera Lens',
                'feedback_type' => '1', //0=suggestion, 1=complaint, 2=others
                'body' => 'Hi, the lens ive gotten appears to be damaged',
                'created_at' => Carbon::now()->subDay()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => '201701039',
                'subject' => 'Thank you!',
                'feedback_type' => '2', //0=suggestion, 1=complaint, 2=others
                'body' => 'Thank you for giving me the latest version!',
                'created_at' => Carbon::now()->subDays(3)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => '201701039',
                'subject' => 'Please add a live chat soon',
                'feedback_type' => '0', //0=suggestion, 1=complaint, 2=others
                'body' => 'I find it hard and tedious to contact the Facilities thru email',
                'created_at' => Carbon::now()->subMonths(2)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'user_id' => '201701039',
                'subject' => 'Broken chair',
                'feedback_type' => '1', //0=suggestion, 1=complaint, 2=others
                'body' => 'I want to return a broken chair. I didnt see the damage upon receiving',
                'created_at' => Carbon::now()->subMonths(5)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
