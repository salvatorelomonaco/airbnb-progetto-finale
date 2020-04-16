<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentSponsorshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_sponsorship', function (Blueprint $table) {

            $table->bigIncrements('id'); // chiave primaria

            $table->bigInteger('apartment_id')->unsigned(); // colonna che conterrà id di apartment
            $table->bigInteger('sponsorship_id')->unsigned(); // colonna che conterrà id dei sponsorship
            $table->timestamp('start_date'); // colonna che conterrà la dat di inizio della sponsorship

            // dichiaro che la chiave (colonna) 'apartment_id' è una FOREIGN KEY (chiave esterna),
            // che fa riferimento alla colonna 'id' della tabella 'apartments'
            $table->foreign('apartment_id')->references('id')->on('apartments');
            // dichiaro che la chiave (colonna) 'sponsorship_id' è una FOREIGN KEY (chiave esterna),
            // che fa riferimento alla colonna 'id' della tabella 'sponsorships'
            $table->foreign('sponsorship_id')->references('id')->on('sponsorships');

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
        Schema::dropIfExists('apartment_sponsorship');
    }
}
