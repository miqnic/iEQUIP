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

            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('due_date')->nullable();
            $table->time('end_time')->nullable();

            $table->string('purpose')->nullable();
            $table->string('room_number')->nullable();
            $table->integer('approval')->nullable();
            $table->boolean('claimed')->nullable();
            $table->boolean('returned')->nullable();
            
            $table->timestamp('submitted_date')->nullable();
            $table->timestamp('claimed_date')->nullable();
            $table->timestamp('returned_date')->nullable();
            $table->timestamp('approval_date')->nullable();
            $table->timestamp('cancelled_date')->nullable();
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
