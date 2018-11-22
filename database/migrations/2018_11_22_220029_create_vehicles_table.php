<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_id')->unique();
            $table->string('product_name');
            $table->string('brand');
            $table->string('body_type');
            $table->string('color');
            $table->integer('no_of_doors');
            $table->string('item_condition');
            $table->integer('seating_capacity');
            $table->double('speed');
            $table->double('acceleration_time');
            $table->double('weight');
            $table->date('model_date');
            $table->date('purchase_date');
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
        Schema::dropIfExists('vehicles');
    }
}
