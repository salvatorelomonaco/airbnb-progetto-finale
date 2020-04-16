<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->bigIncrements('id');
            //
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('state');
            $table->string('city');
            $table->string('street');
            $table->string('number'); // numero civico
            $table->string('zip');
            $table->float('lon', 9,6);
            $table->float('lat', 8,6);
            $table->integer('views'); // numero visualizzazioni pagina
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            //
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
        Schema::dropIfExists('apartments');
    }
}
