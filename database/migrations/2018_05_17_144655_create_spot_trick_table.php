<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpotTrickTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spot_trick', function (Blueprint $table) {
            $table->integer('spot_id')->unsigned();
            $table->foreign('spot_id')->references('id')->on('spots');
            $table->integer('trick_id')->unsigned();
            $table->foreign('trick_id')->references('id')->on('tricks');
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
        Schema::dropIfExists('spot_trick');
    }
}
