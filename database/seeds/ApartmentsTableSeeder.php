Apartment<?php

use Illuminate\Database\Seeder;

// aggiungo il modello su cui devo lavorare
use App\Apartment;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     //



    public function run()
    {
        // leggo il file 'apartment.php' dove c'e un array con chiave 'apt_table'
        $apartments = config('apartment.apt_table');
        // ciclo i dati letti dal file
        foreach ($apartments as $apartment) {
            // creo un nuovo oggetto di tipo Apartment
            $new_apt = new Apartment();

            // ci assegno i dati che ho messo in '$apartment', letti dal file apartment.php, cioè l'array con chiave 'apt_table'
            $new_apt->fill($apartment);

            // salvo l'oggetto nel DB
            $new_apt->save();
        }
    }
}
