<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Charts\Graphic;

use App\Apartment;
use App\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function message(Apartment $apartment) {

        if (Auth::user()->id == $apartment->user_id){
            $messages = Message::where('apartment_id', $apartment->id)->paginate(5);

            return view('admin.request', ['apartment' => $apartment, 'messages' => $messages]);
        } else {
            // l'appartamento in aggiornamento non appartiene all'utente loggato
            // visualizzo una pagina che lo informa
            return view('admin.not_authorized');
        }
    }

    public function statistics(Apartment $apartment) {

        if (Auth::user()->id == $apartment->user_id){
            
            $messages_count = count(Message::where('apartment_id', $apartment->id)->get());

            $gennaio = Message::where('apartment_id', $apartment->id)->whereMonth('created_at', date('01'))->count();
            $febbraio = Message::where('apartment_id', $apartment->id)->whereMonth('created_at', date('02'))->count();
            $marzo = Message::where('apartment_id', $apartment->id)->whereMonth('created_at', date('03'))->count();
            $aprile = Message::where('apartment_id', $apartment->id)->whereMonth('created_at', date('04'))->count();
            $maggio = Message::where('apartment_id', $apartment->id)->whereMonth('created_at', date('05'))->count();
            $giugno = Message::where('apartment_id', $apartment->id)->whereMonth('created_at', date('06'))->count();
            $luglio = Message::where('apartment_id', $apartment->id)->whereMonth('created_at', date('07'))->count();
            $agosto = Message::where('apartment_id', $apartment->id)->whereMonth('created_at', date('08'))->count();
            $settembre = Message::where('apartment_id', $apartment->id)->whereMonth('created_at', date('09'))->count();
            $ottobre = Message::where('apartment_id', $apartment->id)->whereMonth('created_at', date('10'))->count();
            $novembre = Message::where('apartment_id', $apartment->id)->whereMonth('created_at', date('11'))->count();
            $dicembre = Message::where('apartment_id', $apartment->id)->whereMonth('created_at', date('12'))->count();

            $color_message = '#61CE4E';

            // $color_views = '#1B3C59';

            $chart = new Graphic;
            $chart->labels(['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre']);
            $chart->dataset('Messaggi', 'line', [$gennaio, $febbraio, $marzo, $aprile, $maggio, $giugno, $luglio, $agosto, $settembre, $ottobre, $novembre, $dicembre])->color($color_message);
            
            return view('admin.statistics', ['apartment' => $apartment, 'messages_count' => $messages_count, 'chart' => $chart]);
            
        } else {
            // l'appartamento in aggiornamento non appartiene all'utente loggato
            // visualizzo una pagina che lo informa
            return view('admin.not_authorized');
        }
    }
}
