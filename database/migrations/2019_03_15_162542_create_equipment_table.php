<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('equip_id')->unique();
            $table->string('transaction_id')->nullable();
            $table->string('equip_name');
            $table->string('equip_category');
            $table->integer('equip_avail');
            $table->integer('equip_penalty');
            $table->mediumText('equip_description');
            $table->boolean('returned');
            $table->string('equip_img');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}
