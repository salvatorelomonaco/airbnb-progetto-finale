<?php

use Illuminate\Database\Seeder;

// aggiungo il modello su cui devo lavorare
use App\Message;


class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     // numero di richieste "fake" da creare
     public $num_of_requests = 200;


    public function run()
    {
        // chiamo la funzione "factory" per $num_of_requests volte, per riempiere le righe della tabella
        factory(App\Message::class, $this->num_of_requests)->create();

    }
}
