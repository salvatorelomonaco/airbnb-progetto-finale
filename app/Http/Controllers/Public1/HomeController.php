<?php

namespace App\Http\Controllers\Public1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;
use App\Info;
use App\Message;
use App\Sponsorship;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\Session; 




class HomeController extends Controller
{
    public function index() {

        $apartments = Apartment::all()->shuffle();

        $all_sponsorships=[];
        foreach ($apartments as $apartment) {
            array_push($all_sponsorships, DB::table('apartment_sponsorship')->where('apartment_id', $apartment->id)->get());
        }

        $active_sponsorships = [];
        // scorro la lista di tutte le sponsorizzazioni per gli appartamenti dell'utente e mi ricavo solo quelle attive
        for ($i=0; $i < count($all_sponsorships); $i++) {
            for ($j=0; $j < count($all_sponsorships[$i]); $j++) {
                // leggo la data di inizio sponsorizzazione
                $start_date = $all_sponsorships[$i][$j]->{'start_date'};
                // la trasformo in un oggettoo Carbon
                $start_date = Carbon::create($start_date);
                // leggo il tipo della sponsorizzazione
                $type = $all_sponsorships[$i][$j]->{'sponsorship_id'};

                // calcolo la durata della sponsorizzazione in 'numero di giorni'
                $num_of_days = ($type == 3 ? 6 : $type);

                // calcolare la end date sommando alla start_date la durata del tipo di sponsorizzazione
                $end_date = $start_date->addDay($num_of_days);

                // verifico se la sponsorizzazione è ancora attiva
                if ($end_date > now('Europe/Rome')) {
                    // la sponsorizzazione è attiva, la metto in elenco nell'array, pushando l'id dell'appartamento
                    array_push($active_sponsorships, $all_sponsorships[$i][$j]->{'apartment_id'});
                }
            }
        }

        $apts_sponsor = Apartment::whereIn('id', $active_sponsorships)->get()->shuffle();

        // dd($apts_sponsor);

        $apts_not_sponsor = Apartment::whereNotIn('id', $active_sponsorships)->get()->shuffle();

        // dd($apts_not_sponsor);

        // calcolo del indice per il foreach dello stamapa card apt
        $apt_num = count($apts_sponsor) >= 3 ? 2 : 5 - count($apts_sponsor);

        return view('public.home', ["apts_not_sponsor"=>$apts_not_sponsor, 'apts_sponsor'=>$apts_sponsor, 'apt_num' => $apt_num]);
    }

    public function show(Apartment $apartment) {

      $Key = 'apartment/' . $apartment->id;
      // dd($Key);
         // if (\Session::has($Key)) {

          DB::table('apartments')
           ->where('id', $apartment->id)
           ->increment('views', 1);
           // \Session::put($Key, 1);
          // }

        return view('public.show', ["apartment"=>$apartment]);
    }

    public function mail(Request $request, Apartment $apartment) {

        $request->validate([
            //
            'email' => ['required', 'string', 'email', 'max:80'],
            'message' => 'required|max:1000', // richiesto e massimo lungo 1000caratteri
        ]);

        $form_data_received = $request->all();

        // creo un nuovo record da scrivere nella tabella "requests"
        $new_message = new Message();

        $new_message->fill($form_data_received);
        $new_message->apartment_id=$apartment->id;

        // salvo messaggio nel DB
        $new_message->save();

        return view('public.message_sent', ["apartment"=>$apartment, 'new_message' => $new_message]);
    }
}
