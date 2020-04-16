<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_service', function (Blueprint $table) {

            $table->bigInteger('apartment_id')->unsigned(); // colonna che conterrà id di apartment
            $table->bigInteger('service_id')->unsigned(); // colonna che conterrà id dei service
            // dichiaro che la chiave (colonna) 'apartment_id' è una FOREIGN KEY (chiave esterna),
            // che fa riferimento alla colonna 'id' della tabella 'apartments'
            $table->foreign('apartment_id')->references('id')->on('apartments');
            // dichiaro che la chiave (colonna) 'service_id' è una FOREIGN KEY (chiave esterna),
            // che fa riferimento alla colonna 'id' della tabella 'services'
            $table->foreign('service_id')->references('id')->on('services');
            // dichiaro che la combinazione delle 2 colonne 'apartment_id' e 'service_id' formano una chiave primaria
            $table->primary(['apartment_id', 'service_id']);

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
        Schema::dropIfExists('apartment_service');
    }
}
