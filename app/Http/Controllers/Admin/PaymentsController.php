<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree_Transaction;
use App\Apartment;
use App\Sponsorship;
use Illuminate\Support\Facades\DB;
// aggiungo questa 'use' per poter usare la funzione Storage()
use Illuminate\Support\Facades\Storage;

class PaymentsController extends Controller
{
    
    public function make(Request $request, Apartment $apartment){   

    $payload = $request->input('payload', false);

    $nonce = $payload['nonce'];

    $status = Braintree_Transaction::sale([
                            'amount' => '2.99',
                            'paymentMethodNonce' => $nonce,
                            'options' => [
                                       'submitForSettlement' => True
                                         ]
                            ]);

    $form_data_received=$request->all();

    if(!empty($form_data_received['sponsorship_id'])) {
        // uso l'attach per aggiungere la sponsorship ricevuta in $request
        // NOTA: la sync() non funzionerebbe perchè cancellerebbe le eventuali sponsorizzazioni
        // già presenti su quell'appartamento
        $apartment->sponsorships()->attach($form_data_received['sponsorship_id']);
    }                  
    
    

    // return response()->json($status);
    // return view('admin.checkout', ['apartment' => $apartment]);
    return redirect() -> route('admin.apartment.checkout', ['apartment' => $apartment]);
    }
}

