<?php

use Illuminate\Database\Seeder;

// aggiungo il modello su cui devo lavorare
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     // numero di utenti "fake" da creare
     public $num_of_users = 10;

    public function run()
    {
        // chiamo la funzione "factory" per num_of_users volte, per riempiere le righe della tabella
        factory(App\User::class, $this->num_of_users)->create();

    }
}
