<?php

namespace App\Http\Controllers\Public1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Apartment;

class SearchController extends Controller
{

    public static function get_distance($latitude1, $longitude1, $latitude2, $longitude2) {
      $theta = $longitude1 - $longitude2;
      $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
      $miles = acos($miles);
      $miles = rad2deg($miles);
      $miles = $miles * 60 * 1.1515;
      // $feet = $miles * 5280;
      // $yards = $feet / 3;
      $kilometers = $miles * 1.609344;
      $meters = $kilometers * 1000;
      return $meters;
    }

    //
    public function search(Request $request) {

        $request->validate([
            'place' => 'required|max:50|min:3'
        ]);

        $data = $request->all();

        if (isset($data['apts_sponsor'])) {
            // leggere dalla tabella apartments tutti gli appartamentoi con sponsorship attive
            // uso l'array apts_sponsor, che contiene un elenco di id, degli appartamenti con sponsor attive
            $apts_sponsor = Apartment::whereIn('id', $data['apts_sponsor'])->get()->shuffle();
        } else {
            $apts_sponsor = [];
        }

        // lat e lon della località inserita dall'utente
        $lat1= $data['lat'];
        $lon1= $data['lon'];

        $apartments = Apartment::whereNotIn('id', $apts_sponsor)->get();

        $apts_id_dist = []; // conterrà una lista di: [id_appartamento => distanza]
        $nearby_apts =[]; // conterrà una collection di appartamenti che soddisfano il raggio di ricerca e sono ordinati per distanza

        foreach ($apartments as $apartment) {
            $lat2= $apartment->lat;
            $lon2= $apartment->lon;

            $distance = $this->get_distance($lat1, $lon1, $lat2, $lon2);

            // cerco appartamenti nel raggio di 20000 metri dalla località scelta dall'utente
            if($distance <= 20000) {
                // creo array associativo, dove la chiave è l'id appartamento e la distanza è il valore
                $apts_id_dist = $apts_id_dist + [($apartment->id) =>$distance];
            }
        }

        // se c'e' almeno 1 appartamento che si trova nel raggio cercato, costruisco un array ordinato
        // per distanza, dal più vicino al più lontano
        if (!empty($apts_id_dist)) {

            // ordino l'array associativo ([id => distanza]) in base alle distanze
            asort($apts_id_dist);

            // estraggo soli gli id, che sono in ordine di distanza (dalla minore alla maggiore)
            $apts_ids=array_keys($apts_id_dist);

            // leggo dal DB gli appartamenti e mi creo una collection ordinata in base all'ordine dell'array di ids
            $ids_ordered = implode(',', $apts_ids);
            $nearby_apts = Apartment::whereIn('id', $apts_ids)
             ->orderByRaw("FIELD(id, $ids_ordered)")
             ->get();
        }

        // passo alla view: la lista degli apts in ordine di distanza, la lista degli apt sponsorizzati, il nome della localià ricercata
        return view('public.search', ['nearby_apts' => $nearby_apts, 'apts_sponsor' => $apts_sponsor, 'place' => $data['place'], 'apts_id_dist' => $apts_id_dist]);
    }
}
