<?php

use Illuminate\Database\Seeder;

// aggiungo il modello su cui devo lavorare
use App\Info;

class InfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     // numero di appartamenti "info" da creare (tanti quanti gli apartments)
     public $num_of_Infos = 30;

    public function run()
    {
        // chiamo la funzione "factory" per num_of_Infos volte, per riempiere le righe della tabella
        factory(App\Info::class, $this->num_of_Infos)->create();

    }
}
