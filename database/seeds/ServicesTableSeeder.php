<?php

use Illuminate\Database\Seeder;

// aggiungo il modello su cui devo lavorare
use App\Service;

class ServicesTableSeeder extends Seeder
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
        $services = config('apt_services.services_table');
        // ciclo i dati letti dal file
        foreach ($services as $service) {
            // creo un nuovo oggetto di tipo Sponsorship
            $new_service = new Service();

            // ci assegno i dati che ho messo in '$Sponsorships', letti dal file sponsorship.php, cioè l'array con chiave 'sponsorship_db'
            $new_service->fill($service);

            // salvo l'oggetto nel DB
            $new_service->save();
        }
    }
}