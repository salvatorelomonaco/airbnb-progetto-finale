<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;

use App\Apartment;
use App\Service;
use App\Info;
use App\Sponsorship;
use Illuminate\Support\Facades\DB;
// aggiungo questa 'use' per poter usare la funzione Storage()
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // questa funzione viene invocata per visualizzare la homepage della parte autenticata,
        // viene mostrata all'utente subito dopo il login

        // recupero l'id dell'utente che è loggato
        $user_id = Auth::user()->id;

        // leggo dal DB tutti gli appartamenti associati all'utente loggato e ottengo una collection
        // imposto anche la paginazione automatica di Laravel
        $apartments = Apartment::where('user_id', $user_id)->withTrashed()->paginate(5);

// dd(count($apartments));

        // contiene tutte le sponsorizzazioni di tutti gli appartamenti di quell'utente (sia scadute che attive)
        $all_sponsorships=[];
        foreach ($apartments as $apartment) {
            array_push($all_sponsorships, DB::table('apartment_sponsorship')->where('apartment_id', $apartment->id)->get());
        }

        // contiene gli id degli apt con associata una sponsorizzazione attiva
        $active_sponsorships = [];
        $type_sponsorships = [];
        $end_sponsorships = [];
        $ext_type = [];
        $ext_end = [];
        // dd($all_sponsorships);
        // scorro la lista di tutte le sponsorizzazioni per gli appartamenti dell'utente e mi ricavo solo quelle attive
        for ($i=0; $i < count($all_sponsorships); $i++) { // scorro gli appartamenti
            for ($j=0; $j < count($all_sponsorships[$i]); $j++) { // scorro le sponsorizzazioni di 1 appartamento
                // leggo la data di inizio sponsorizzazione
                $start_date = $all_sponsorships[$i][$j]->{'start_date'};
                // la trasformo in un oggettoo Carbon
                $start_date = Carbon::create($start_date);
                // leggo il tipo della sponsorizzazione
                $type = $all_sponsorships[$i][$j]->{'sponsorship_id'};

                // calcolo la durata della sponsorizzazione in 'numero di giorni'
                $num_of_days = ($type == 3 ? 6 : $type);

                // if ($type ==3) {
                //     $num_of_days=6;
                // } else {
                //     $num_of_days = $type;
                // }

                // calcolare la end date sommando alla start_date la durata del tipo di sponsorizzazione
                $end_date = $start_date->addDay($num_of_days);

                // verifico se la sponsorizzazione è ancora attiva
                //dd($end_date, now('Europe/Rome'));
                if ($end_date > now('Europe/Rome')) {
                    // la sponsorizzazione è attiva, la metto in elenco nell'array, pushando l'id dell'appartamento
                    array_push($active_sponsorships, $all_sponsorships[$i][$j]->{'apartment_id'});

                    switch ($type) {
                        case '1':
                            $type_string = "BASE";
                            break;
                        case '2':
                            $type_string = "DOUBLE";
                            break;
                        case '3':
                            $type_string = "PREMIUM";
                            break;
                        default:
                            $type_string = "BASE";
                            break;
                    }
                    array_push($type_sponsorships, $type_string); // tipo di sponsorizzazione

                    // trasforma la data in un formato localizzato "italiano"
                    $end_date = $end_date->locale('it')->isoFormat('dddd, D MMMM YYYY, H:mm');
                    array_push($end_sponsorships, $end_date); // data di fine sponsorizzazione
                }
            }
        }

        // scorro apartments se id in apartments c'e' in active_sponsorships, scrivo il type in ext_type, e incremto indice su type,
        // altrimenti scrivo 0 in ext_type
        //
        // stessa cosa per apartments e end_date scrivero un ext_end_date
        $index=0;
        foreach ($apartments as $apartment) {
           // ciclo tutti gli appartamenti dell'utente
            if (in_array($apartment->id, $active_sponsorships)) {
                array_push($ext_type, $type_sponsorships[$index]);
                array_push($ext_end, $end_sponsorships[$index]);
                $index++;
            } else {
                array_push($ext_type, "");
                array_push($ext_end, "");
            }
        }

// dd($active_sponsorships, $ext_type, $ext_end);

        //dd($active_sponsorships, $type_sponsorships, $end_sponsorships);

        // ritorno la view che visualizzerà una pagina con l'elenco degli appartamenti dell'utente loggato
        // gli passo anche l'elenco delle sponsorizzazioni attive
        return view('admin.index', ['apartments' => $apartments,
                    'active_sponsorships' =>$active_sponsorships,
                    'type_sponsorships' =>$ext_type,
                    'end_sponsorships' =>$ext_end]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // questa funzione permette all'utente di creare un nuovo appartamento che verrà salvato nel DB

        // leggo l'elenco  dei servizi presenti nel DB, ottengo una collection
        $services = Service::all();

        // ritorno una vista che è un megaForm per l'inerimento di tutti i dati associati ad un appartamento
        // gli passo anche l'elenco con i nomi dei servizi associabili all'appartemento
        return view("admin.create", ['services' => $services]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // questa funzione memorizza i dati di un nuovo appartamento nel DB
        // scrive in 3 tabelle diverse: apartments, infos e apartments_services


        // ----------------------------- VALIDAZIONE DATI -------------------------------------
        // questi sono tutti i dati che mi arrivano, sui quali applico delle regole di validazione
        // in base anche a quello che ho definito nel mio DB
        $request->validate([
            // tabella apartments
            'title' => 'required|max:255', // richiesto e massimo lungo 255caratteri
            'state' => 'required|max:50', // richiesto e massimo lungo 50caratteri
            'city' => 'required|max:50', // richiesto e massimo lungo 50caratteri
            'street' => 'required|max:80', // richiesto e massimo lungo 255caratteri
            'number' => 'required|max:5', // massimo numero di cifre che compongono il numero
            'zip' => 'required|max:5', //  massimo numero di cifre che compongono il numero

            // tabella infos
            'summary' => 'required|max:1000', //  massimo numero di caratteri
            'room_num' => 'required|max:2', //  massimo numero di cifre che compongono il numero
            'beds_num' => 'required|max:2', //  massimo numero di cifre che compongono il numero
            'bathroom_num' => 'required|max:1', //  massimo numero di cifre che compongono il numero
            'sq_mt' => 'required|max:3', //  massimo numero di cifre che compongono il numero
            'image' => 'image' // deve essere una file di immagine

        ]);
        // ----------------------------- VALIDAZIONE DATI -------------------------------------

// ********************** TABELLA 'apartments' **********************
        // recupero l'id dell'utente che è loggato
        $user_id = Auth::user()->id;

        // metto i dati ricevuti (in appartamento) tramite il parametro $request in una variabile (che è un array)
        $form_data_received=$request->all();

        // creo un nuovo oggetto di classe Apartment, da scrivere poi nel DB
        $new_apartment = new Apartment();
        // valorizzo il nuovo oggetto con i dati ricevuti
        $new_apartment->fill($form_data_received);

        // scrivo nel nuovo oggetto apartment, l'id dell'utente
        $new_apartment->user_id=$user_id;

        // metto a zero, il valore iniziale delle visualizzazioni dell'appartmaneto
        $new_apartment->views=0;

        // alla fine scrivo il nuovo oggetto nel DB
        $new_apartment->save();


// ******************* TABELLA 'infos' **********************
        // creo un nuovo oggetto di classe Info, da scrivere poi nel DB
        $new_info = new Info();
        // valorizzo il nuovo oggetto con i dati ricevuti
        $new_info->fill($form_data_received);

        // ----------------------------- GESTIONE FILEs -------------------------------------
        // si compone sinteticamente di 3 steps:
        // 1. l'utente seleziona un file tramite l'apposito campo del form
        // 2. recupero il path di questo file e lo passo ad una funzione 'put' che ne fa una copia in una cartella ('uploads')
        // della mia applicazione e in più mi restituise il percorso di dove ha messo questa copia
        // 3. salvo nel DB, nell'apposita colonna che ho creato (image), il percorso del file
        //
        // ulteriori steps da fare:
        // 1. nel file 'config/filesystems.php' metto il valore 'public', come scritto qui sotto
        // 'default' => env('FILESYSTEM_DRIVER', 'public'),
        // 2. creare da terminale (attenzione NON powershell, ma semplice terminale) un SYMLINK (link virtuale che viene creato sotto
        // la cartella 'public') che punterà alla cartella dove fisicamente sono memorizzati i file, ovvero "storage/app/public/uploads"
        // dare il comando:
        // >php artisan storage:link
        // se non funzionasse provare:
        // >mklink /J public\storage storage\app\public

        // verifico che l'elemento 'image' ricevuto dal form non sia vuoto
        // accedo all'array con la chiave associativa ('image') che identifica quell'elemento
        // è l'attributo 'name' del tag <input> del form che ha ricevuto il nome del file selezionato dall'utente
        if(!empty($form_data_received['image'])) {
            // estraggo il percorso del file selezionato dall'utente tramite il form della view 'create'
            $image = $form_data_received['image'];
            // la cartella 'uploads', la creo io e conterrà i files che carica l'utente, verrà creata sotto storage\app\public\
            // passo alla funzione 'put' 2 parametri:
            // la cartella ('uploads') dove mettere il file  il percorso ('$image') da dove prendere il file
            // la 'put', oltre a fare la copia  del file, mi restituisce il path di dove ha salvato il file, scriverò questo path nel DB
            $image_path = Storage::put('uploads', $image);

            // inserico nell'oggetto $new_info il path ottenuto, poi dopo l'oggetto $new_info lo salvo nel DB
            $new_info->image = $image_path;
        }
        // ------------------------------ GESTIONE FILEs -------------------------------------

        // recupero l'id dell'appartamento che ho appena inserito nella tabella apartments,
        // poichè devo inserirlo nella colonna apartment_id(FK) della tabella infos
        $apt_id = DB::table('apartments')->latest()->first()->id;

        // inserisco l'id dell'appartamento appena inserito nel DB, nell'oggetto di classe Info
        // che poi andrò a scrivere nella tabella infos
        $new_info->apartment_id=$apt_id;

        // alla fine scrivo il nuovo oggetto nel DB
        $new_info->save();


// ******************* TABELLA 'apartments_services' **********************
        // verifico se sono stati selezionati dei servizi, nel caso li assegno all'appartamento e scrivo nel DB.
        // service_id è l'array che ho usato nel form e che deve contenere i servizi checkati dall'utente
        // (l'utente potrebbe anche non selezionarne alcuno ovviamente...)
        if(!empty($form_data_received['service_id'])) {

            // scrivo i servizi dell'appartamento ($new_apartment->services()) chiamando la sync()
            // la sync() prende in input un array di servizi e fa una 'sincronizzazione'
            // la sync() aggiunge al appartamento i servizi che trova nell'array che gli passo e rimuove tutti gli altri
            $new_apartment->services()->sync($form_data_received['service_id']);

            // DOCUMENTATION LARAVEL:
            // You may also use the sync method to construct many-to-many associations.
            // The sync method accepts an array of IDs to place on the intermediate table.
            // Any IDs that are not in the given array will be removed from the intermediate table.
            // So, after this operation is complete, only the IDs in the given array will exist in the intermediate table

        }

        // faccio una REDIRECT verso la rotta 'apartment.index'
        return redirect() -> route('admin.apartment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(Apartment $apartment, Info $info)
    public function show(Apartment $apartment)
    {
        if (Auth::user()->id == $apartment->user_id){
            // l'appartamento da aggiornare appartiene all'utente attualmente loggato, l'update è permesso

            // ritorno la view show passandogli la variabile $apartment ricevuta in ingresso
            return view('admin.show',['apartment' => $apartment]);
        } else {
            // l'appartamento in aggiornamento non appartiene all'utente loggato
            // visualizzo una pagina che lo informa
             return view('admin.not_authorized');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        //
        if (Auth::user()->id == $apartment->user_id){
            // l'appartamento da aggiornare appartiene all'utente attualmente loggato, l'update è permesso

            // leggo l'elenco  dei servizi presenti nel DB, ottengo una collection
            $services = Service::all();

            // gli passo anche l'elenco con i nomi dei servizi associabili all'appartemento
            return view('admin.edit',['apartment' => $apartment, 'services' => $services ]);

        } else {
            // l'appartamento in aggiornamento non appartiene all'utente loggato
            // visualizzo una pagina che lo informa
             return view('admin.not_authorized');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
        if (Auth::user()->id == $apartment->user_id){
            // l'appartamento da aggiornare appartiene all'utente attualmente loggato, l'update è permesso

            // ----------------------------- VALIDAZIONE DATI -------------------------------------
            // questi sono tutti i dati che mi arrivano, sui quali applico delle regole di validazione
            // in base anche a quello che ho definito nel mio DB
            $request->validate([
                // tabella apartments
                'title' => 'required|max:255', // richiesto e massimo lungo 255caratteri
                'state' => 'required|max:50', // richiesto e massimo lungo 50caratteri
                'city' => 'required|max:50', // richiesto e massimo lungo 50caratteri
                'street' => 'required|max:80', // richiesto e massimo lungo 255caratteri
                'number' => 'required|max:5', // massimo numero di cifre che compongono il numero
                'zip' => 'required|max:5', //  massimo numero di cifre che compongono il numero

                // tabella infos
                'summary' => 'required|max:1000', //  massimo numero di caratteri
                'room_num' => 'required|max:2', //  massimo numero di cifre che compongono il numero
                'beds_num' => 'required|max:2', //  massimo numero di cifre che compongono il numero
                'bathroom_num' => 'required|max:1', //  massimo numero di cifre che compongono il numero
                'sq_mt' => 'required|max:3', //  massimo numero di cifre che compongono il numero
                'image' => 'image' // deve essere una file di immagine

            ]);
            // ----------------------------- VALIDAZIONE DATI -------------------------------------

            $form_data_received=$request->all();

            // scrivo nella tabella apartments
            $apartment->update($form_data_received);

            // scrivo nella tabella apartment_service
            // aggiorno i servizi nel DB
            // service_id è l'array che ho usato nel form e che deve contenere i servizi checkati dall'utente
            // (l'utente potrebbe anche non selezionarne alcuno ovviamente...)
            // se così fosse nella collection che mi arriva, la chiave service_id non sarebbe definita
             if(isset($form_data_received['service_id'])) {
                // aggiorno i servizi dell'appartamento ($apartament->services()) chiamando la sync()
                // la sync() prende in input un array di servizi e fa una 'sincronizzazione'
                // la sync() aggiunge all'appartamento i servizi che trova nell'array che gli passo e rimuove tutti gli altri
                $apartment->services()->sync($form_data_received['service_id']);
            } else {
                // la chiave 'service_id' non è definita nell'array di dati che mi è arrivato
                // assumo che non ci siano servizi da associare all'appartamento, passo alla sync() un array vuoto
                $apartment->services()->sync([]);
            }

            // ----------------------------- GESTIONE FILEs -------------------------------------
            // si compone sinteticamente di 3 steps:
            // 1. l'utente seleziona un file tramite l'apposito campo del form
            // 2. recupero il path di questo file e lo passo ad una funzione 'put' che ne fa una copia in una cartella ('uploads')
            // della mia applicazione Laravel e in più mi restituise il percorso di dove ha messo questa copia
            // 3. inserisco il nuovo path nell'oggetto che userò per fare l'update del DB
            //
            // verifico che il campo image ricevuto dal form non sia vuoto
            if(!empty($form_data_received['image'])) {

                // se l'appartamento aveva già un'immagine associata, la cancello prima di collegare quella nuova
                if(!empty($apartment->image)) {
                    // cancello l'immagine precedente, viene fisicamente eliminato il file dalla cartella 'uploads'
                    Storage::delete($apartment->image);
                }

                // estraggo il percorso del file selezionato dall'utente
                $image = $form_data_received['image'];
                // passo alla funzione 'put' 2 parametri:
                // la cartella ('uploads') dove mettere il file e il percorso ('$image') da dove prendere il file
                // la 'put', oltre a fare la copia del file, mi restituisce il path di dove ha salvato il file
                $image_path = Storage::put('uploads', $image);

                // inserico il nuovo path fornitomi dalla funzione 'put' nell'oggetto che contiene i dati da aggiornare
                $apartment->info->image = $image_path;
            }
            // ------------------------------ GESTIONE FILEs -------------------------------------

            // scrivo nella tabella infos
            // NOTA: l'update() lavora solo sui dati dichiarati "fillable"
            $apartment->info->update($form_data_received);

            return redirect() -> route('admin.apartment.index');

        } else {
            // l'appartamento in aggiornamento non appartiene all'utente loggato
            // visualizzo una pagina che lo informa
             return view('admin.not_authorized');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {

        $apartment->delete();
        return redirect() -> route('admin.apartment.index');

    }


    public function restore($id)
    {
        Apartment::onlyTrashed()->where('id', $id)->restore();

        return redirect() -> route('admin.apartment.index');

    }
    // public function sponsor(Apartment $apartment)
    public function sponsor(Apartment $apartment)
    {
        if (Auth::user()->id == $apartment->user_id){
            // leggo l'elenco dele sponsorship presenti nel DB, ottengo una collection
            $sponsorships = Sponsorship::all();

            return view('admin.sponsor', ['apartment' => $apartment, 'sponsorships' => $sponsorships]);

        } else {
            // l'appartamento in aggiornamento non appartiene all'utente loggato
            // visualizzo una pagina che lo informa
            return view('admin.not_authorized');
        }
    }


    public function checkout(Request $request, Apartment $apartment)
    {
        if (Auth::user()->id == $apartment->user_id){

            return view('admin.checkout', ['apartment' => $apartment]);
        } else {
            // l'appartamento in aggiornamento non appartiene all'utente loggato
            // visualizzo una pagina che lo informa
            return view('admin.not_authorized');
        }

    }

}
