@extends('layouts.view_structure')

{{-- imposto il titolo della pagina --}}
@section('page-title', "BoolBnB - Dettagli appartamento")


@section('content')
<div class="container">

    {{-- il blocco che segue serve per la validazione, 'lato server', dei dati del form --}}
    @if ($errors->any())
    <div class="alert alert-danger mt-5">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    {{-- immagine, titolo e indirizzo --}}
    <div class="row margin-top-xl">
        <div class="card apt-show col-sm-12 col-lg-6">
            <img class="card-img-top apt-img-lg mt-3 mb-3" src="{{$apartment->info->image ? asset('storage/' . $apartment->info->image) : asset('storage/uploads/no_apt_img.png')}}" alt="{{$apartment->title}}">
        </div>
        <div class="apt-show card card-body col-sm-12 col-lg-5 offset-lg-1">
            <h2>{{$apartment->title}}</h2>
            <div class="address">
                <h5 class="card-title">Indirizzo</h5>
                <p class="card-text">
                    <ul class="list-group">
                    <li class="list-group-item">{{$apartment->street}}, {{$apartment->number}}</li>
                    <li class="list-group-item">{{$apartment->city}}, {{$apartment->zip}}, {{$apartment->state}}</li>
                </ul>
                </p>
            </div>
        </div>
    </div>

    {{-- descrizione, spazi e servizi --}}
    <div class="row">
        <div class="card apt-show card-body col-sm-12 col-lg-6">
            <h5 class="card-title">Descrizione</h5>
            <p class="card-text">{{$apartment->info->summary}}</p>
        </div>

        <div class="apt-show card card-body col-sm-12 col-lg-5 offset-lg-1">
            <div class="">
                <h5 class="card-title">Spazi</h5>
                <p class="card-text">
                    <ul class="list-group">
                        <li class="list-group-item">Stanze: {{$apartment->info->room_num}}</li>
                        <li class="list-group-item">Posti letto: {{$apartment->info->beds_num}}</li>
                        <li class="list-group-item">Bagni: {{$apartment->info->bathroom_num}}</li>
                        <li class="list-group-item">Metri quadri: {{$apartment->info->sq_mt}}</li>
                    </ul>
                </p>

                <h5 class="card-title">Servizi</h5>
                <p class="card-text">
                    <ul class="list-group">
                        @forelse ($apartment->services as $service)
                            <li class='list-group-item'>{{$service->service}}</li>
                        @empty
                            <li class='list-group-item'>Non sono presenti servizi</li>
                        @endforelse
                    </ul>
                </p>
            </div>
        </div>
    </div>

    {{-- mappa, email --}}
    <div class="row margin-bottom-xl">
        <div class="map card card-body apt-show col-sm-12 col-lg-6">
            <div id="map" data-lat="{{ $apartment->lat }}" data-lon="{{ $apartment->lon }}"
                          data-address="{{ $apartment->street }} {{ $apartment->number }},
                                        {{ $apartment->zip }} {{ $apartment->city }}, {{ $apartment->state }}">
            </div>
        </div>

        <div class="email card card-body apt-show col-sm-12 col-lg-5 offset-lg-1">
            <form method="post" action="{{ route("public.mail", ['apartment' => $apartment->id]) }}">
                @csrf
                <div class="form-group">
                    <label for="email">Indirizzo e-mail</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Inserisci la tua e-mail"
                    {{-- se l'utente è loggato, uso il suo indirizzo e-mail per autocompletaare ill campo di input --}}
                    value="{{ Auth::check() ? Auth::user()->email : "" }}" required>
                </div>
                <div class="form-group">
                    <label for="msg">Messaggio:</label>
                    <textarea id="msg" name="message" rows="6" class="form-control" placeholder="Inserisci il testo dell'e-mail..." required></textarea>
                </div>
                <button class="float-right btn btn-success" type="submit" data-toggle="tooltip" data-placement="left"  data-html="true" title="<span class='green-text'>Invia il messaggio</span>">
                    <i class="fab fa-telegram-plane fa-2x"></i>
                </button>
            </form>
        </div>
    </div>




</div>
@endsection
