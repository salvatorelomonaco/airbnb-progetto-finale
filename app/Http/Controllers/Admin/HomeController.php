<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;


use App\Apartment;
use App\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App;


class HomeController extends Controller
{
    // funzione per visualizzare la home page per l'utente autenticato
    public function index()
    {
        return view('admin.home');
    }


    // funzione per visualizzare i dati del profilo dell'utente
    public function account() {

        // recupero i dettagli dell'utente corrente tramite la relazione uno a uno
        $user_details = Auth::user();

        $date_of_birth = new Carbon ($user_details->date_of_birth);
        $date_of_birth_it = $date_of_birth->locale('it')->isoFormat('dddd, D MMMM YYYY');

        $date = new Carbon ($user_details->created_at);
        $date_it = $date->locale('it')->isoFormat('dddd, D MMMM YYYY, h:mm');

        // ritorno la view admin.account e le passo i dettagli utente
        return view('admin.account', ['user_details' => $user_details,
                    'reg_date' => $date_it,
                    'date_of_birth' => $date_of_birth_it]);
    }

}
