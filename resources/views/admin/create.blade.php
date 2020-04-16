@extends('layouts.view_structure')

{{-- imposto il titolo della pagina --}}
@section('page-title', "BoolBnB - Inserisci nuovo appartamento")

@section('content')
    <section class="container margin-top-xl margin-bottom-xl">

        <div class="clearfix">
            <h1 class="d-inline-block col-9 mb-3">Inserimento nuovo appartamento</h1>
            <a class="icon-blue show-btn btn btn-primary float-right" href="{{ route('admin.apartment.index') }}" data-toggle="tooltip" data-placement="bottom"  data-html="true" title="<span class='green-text'>Elenco appartamenti</span>">
                {{-- Elenco appartamenti --}}
                <i class="fas fa-list-ul fa-2x"></i>
            </a>
        </div>

        <div>

            {{-- il blocco che segue serve per la validazione, 'lato server', dei dati del form --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- il blocco che segue serve per la validazione, 'lato client', dei dati del form --}}
            <div id="err-list" class="alert alert-danger d-none">
                <ul>
                    <li id="err-title" class="d-none">Il campo Titolo è obbligatorio.</li>
                    <li id="err-street" class="d-none">Il campo Via/Piazza è obbligatorio.</li>
                    <li id="err-number" class="d-none">Il campo Numero civico è obbligatorio.</li>
                    <li id="err-city" class="d-none">Il campo Città è obbligatorio.</li>
                    <li id="err-zip" class="d-none">Il campo CAP è obbligatorio.</li>
                    <li id="err-state" class="d-none">Il campo Stato è obbligatorio.</li>
                    <li id="err-summary" class="d-none">Il campo Decrizione dettagliata è obbligatorio.</li>
                    <li id="err-room-num" class="d-none">Il campo Numero di stanze è obbligatorio.</li>
                    <li id="err-beds-num" class="d-none">Il campo Numero di letti è obbligatorio.</li>
                    <li id="err-bathroom" class="d-none">Il campo Numero di bagni è obbligatorio.</li>
                    <li id="err-sq-mt" class="d-none">Il campo Superficie(mq) è obbligatorio.</li>
                </ul>
            </div>

            {{-- al submit chiamo la route 'store' che non corrisponde ad una view da visualizzare, --}}
            {{-- ma è solo del codice che elabora i dati del form e crea un oggetto Apartment da scrivere nel DB --}}

            {{-- NOTA: perchè il form possa gestire anche i file bisogna aggiungere questo attributo:
                 enctype="multipart/form-data" --}}
            <form class="w-100" enctype="multipart/form-data" method="post" action="{{ route('admin.apartment.store') }}">

                @csrf

                <div class="container">

                    <h5>Titolo</h5>
                    <div class="row apt-show-row">
                        <div class="form-group col-12">
                            <label for="title">Descrizione sintetica (max 255 caratteri):</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="descrivi brevemente il tuo appartamento" value="{{ old('title') }}">
                        </div>
                    </div>

                    <h5>Indirizzo</h5>
                    <div class="row apt-show-row">
                        <div class="form-group col-12 col-sm-9 col-lg-8">
                            <label for="street">Via/Piazza/etc (max 80 caratteri):</label>
                            <input type="text" class="form-control street-field" id="street" name="street" placeholder="inserisci l'indirizzo" value="{{ old('street') }}">
                        </div>

                        <div class="form-group col-5 col-sm-3 col-lg-2">
                            <label for="number">Numero civico:</label>
                            <input type="text" class="form-control number-field" id="number" name="number" placeholder="inserisci il numero civico" value="{{ old('number') }}">
                        </div>

                        <div class="form-group col-8 col-sm-6 col-lg-5">
                            <label for="city">Città (max 50 caratteri):</label>
                            <input type="text" class="form-control city-field" id="city" name="city" placeholder="inserisci la città" value="{{ old('city') }}">
                        </div>

                        <div class="form-group col-4 col-sm-4 col-lg-3">
                            <label for="zip">CAP:</label>
                            <input type="text" class="form-control zip-field" id="zip" name="zip" placeholder="inserisci il CAP" value="{{ old('zip') }}">
                        </div>

                        <div class="form-group col-9 col-sm-6 col-lg-4">
                            <label for="state">Stato (max 50 caratteri):</label>
                            <input type="text" class="form-control state-field" id="state" name="state" placeholder="inserisci la nazione" value="{{ old('state') }}">
                        </div>
                    </div>

                    {{-- campi nascosti per salvare i valori di latitudine e longitudine che arrivano da chiamata AJAX a TomTom --}}
                    <div class="form-group">
                      <input class="lat-input" type="hidden" name="lat" value="{{ old('lat') }}">
                      <input class="lon-input" type="hidden" name="lon" value="{{ old('lon') }}">
                    </div>

                    <h5>Descrizione</h5>
                    <div class="row apt-show-row">
                        <div class="form-group col-12">
                            <label for="summary">Descrizione dettagliata (max 1000 caratteri):</label>
                            <textarea class="form-control" id="summary" rows=6 name="summary" placeholder="scrivi qui una descrizione del tuo appartamento...">{{ old('summary') }}</textarea>
                        </div>
                    </div>

                    <h5>Spazi</h5>
                    <div class="row apt-show-row">
                        <div class="form-group col-6 col-sm-3">
                            <label for="room_num">N. stanze:</label>
                            <input type="number" class="form-control" id="room_num" name="room_num" min="1" max="10" placeholder="inserisci numero di stanze" value="{{ old('room_num') }}">
                        </div>

                        <div class="form-group col-6 col-sm-3">
                            <label for="beds_num">N. letti:</label>
                            <input type="number" class="form-control" id="beds_num" name="beds_num" min="1" max="10" placeholder="inserisci numero di letti" value="{{ old('beds_num') }}">
                        </div>

                        <div class="form-group col-6 col-sm-3">
                            <label for="bathroom_num">N. bagni:</label>
                            <input type="number" class="form-control" id="bathroom_num" name="bathroom_num" min="1" max="5" placeholder="inserisci numero di bagni" value="{{ old('bathroom_num') }}">
                        </div>

                        <div class="form-group col-6 col-sm-3">
                            <label for="sq_mt">Superficie(mq):</label>
                            <input type="number" class="form-control" id="sq_mt" name="sq_mt" min="25" max="200" placeholder="inserisci la metratura" value="{{ old('sq_mt') }}">
                        </div>
                    </div>

                    <h5>Servizi</h5>
                    <div class="row apt-show-row">
                        <div class="form-group col-12">
                            @if($services->count() > 0)
                                <p>Seleziona i servizi</p>
                                @foreach ($services as $service)
                                    <label for="service_{{ $service->id }}">
                                        <input id="service_{{ $service->id }}" type="checkbox" name="service_id[]" value="{{ $service->id }}"
                                        {{in_array($service->id, old('service_id', array())) ? 'checked' : ''}} >
                                        {{ $service->service }}
                                    </label>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- questo campo serve per la selezione del file immagine, l'attributo 'type' dell'<input> è "file" --}}
                    <h5>Immagine</h5>
                    <div class="row apt-show-row">
                        <div class="form-group  col-12">
                            <label for="image">Carica un'mmagine dell'appartamento:</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </div>

                    {{--  ---------------- VALIDAZIONE DATI - GESTIONE ERRORI ------------------------------- --}}
                    {{-- PREMESSA: se l'utente ha inserito dei dati non validi, al submit l'elaborazione del form non procede e
                    la pagina viene ricaricata. Bisogna capire cosa far vedere all'utente. In generale se aveva valorizzato
                    dei campi del form, al ricaricamento bisogna ripresentargli quei valori che aveva inserito.
                    Laravel ci mette  disposizione la funzione "old()" che, dopo il ricaricamento della pagina,
                    ci fornisce, per ogni campo del form, il valore che l'utente aveva precedentemente inserito.
                    con old('attributo_name_del_campo_del_form') abbiamo a disposizione quel valore.
                    alla old() posso passare anche un secondo parametro, è un valore che viene usato come default nel caso in cui
                    non sia presente un valore "old" per quel campo, cioè l'utente non aveva valorizzato il campo  --}}
                    {{--  ---------------- VALIDAZIONE DATI - GESTIONE ERRORI ------------------------------- --}}

                    <div class="margin-bottom-xl">
                        <button type="reset" class="btn icon-blue">Reset</button>
                        @include('admin.create_modal')
                    </div>


                </div>
            </form>

        </div>

    </section>
@endsection
