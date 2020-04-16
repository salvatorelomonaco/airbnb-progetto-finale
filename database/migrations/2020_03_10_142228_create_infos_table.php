<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('apartment_id');

            $table->text('summary');
            $table->tinyInteger('room_num');
            $table->tinyInteger('beds_num');
            $table->tinyInteger('bathroom_num');
            $table->integer('sq_mt');
            $table->string('image')->nullable();

            $table->foreign('apartment_id')->references('id')->on('apartments');

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
        Schema::dropIfExists('infos');
    }
}
