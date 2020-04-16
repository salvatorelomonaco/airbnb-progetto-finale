<?php

use Illuminate\Database\Seeder;

// aggiungo il modello su cui devo lavorare
use App\Sponsorship;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //

        // leggo il file 'sponsorships.php' dove c'e un array con chiave 'sponsorships_table'
        $sponsorships = config('sponsorships.sponsorships_table');
        // ciclo i dati letti dal file
        foreach ($sponsorships as $sponsorship) {
            // creo un nuovo oggetto di tipo Sponsorship
            $new_sponsorship = new Sponsorship();

            // ci assegno i dati che ho messo in '$Sponsorships', letti dal file sponsorship.php, cioè l'array con chiave 'sponsorship_db'
            $new_sponsorship->fill($sponsorship);

            // salvo l'oggetto nel DB
            $new_sponsorship->save();
        }
    }
}
