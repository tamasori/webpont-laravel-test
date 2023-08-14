<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_information', function (Blueprint $table) {
            $table->id();
            $table->dateTime('measured_at');
            $table->foreignId('city_id')->references('id')->on('cities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('temperature');
            $table->integer('pressure');
            $table->integer('humidity');
            $table->float('min_temperature');
            $table->float('max_temperature');
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
        Schema::dropIfExists('weather_information');
    }
};
