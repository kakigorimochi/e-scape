<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journeys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('origin_id')->unsigned();
            $table->integer('destination_id')->unsigned();
            $table->decimal('amount')->default(0);
            $table->tinyInteger('origin_type')->default(0)->comment('0 = northbound, 1 southbound');
            $table->tinyInteger('status')->default(0)->comment('0 = cancelled, 1 = paid, 2 = pending');
            $table->timestamps();

            $table->foreign('origin_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('destination_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journeys');
    }
}
