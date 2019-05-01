<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_forms', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('transaction_id')->unique();
            $table->string('user_id');
            $table->date('start_date');
            $table->date('due_date');
            $table->timestamp('submitted_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('purpose');
            $table->string('room_number');
            $table->integer('approval');
            $table->boolean('claiming');
            $table->rememberToken();

            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_forms');
    }
}
