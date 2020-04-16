@extends('layouts.view_structure')

{{-- imposto il titolo della pagina --}}
@section('page-title', "BoolBnB - Dettagli appartamento")


@section('content')
<div class="container">
    <div class="margin-top-xl row title-btn d-flex">
        <div class="show-title-container">
            <div class="d-flex">
                <h1 class="title-show-admin d-inline-block mb-5">Dettagli appartamento</h1>
            </div>
        </div>
        <div class="show-btn-container d-flex flex-row-reverse mb-5">
            <a class="icon-blue show-btn btn btn-primary float-right" href="{{ route('admin.apartment.messages', ['apartment' => $apartment->id]) }}" data-toggle="tooltip" data-placement="bottom"  data-html="true" title="<span class='green-text'>Richieste ricevute</span>">
                {{-- Richieste --}}
                <i class="fas fa-envelope fa-2x"></i>
            </a>
            <a class="icon-blue show-btn btn btn-primary float-right" href="{{ route('admin.apartment.statistics', ['apartment' => $apartment->id]) }}" data-toggle="tooltip" data-placement="bottom"  data-html="true" title="<span class='green-text'>Statistiche</span>">
                {{-- Statistiche --}}
                <i class="fas fa-chart-area fa-2x"></i>
            </a>
            <a class="icon-blue show-btn btn btn-primary float-right" href="{{ route('admin.apartment.index') }}" data-toggle="tooltip" data-placement="bottom"  data-html="true" title="<span class='green-text'>Elenco appartamenti</span>">
                {{-- Elenco appartamenti --}}
                <i class="fas fa-list-ul fa-2x"></i>
            </a>
        </div>
    </div>

    {{-- immagine, titolo e indirizzo --}}
    <div class="row">
        <div class="card-apt-show-sm card-apt-show-caract card-apt-show-space col-md-12 col-lg-6">
            <img class="img-show-admin card-body card-img-top apt-img-lg" src="{{$apartment->info->image ? asset('storage/' . $apartment->info->image) : asset('storage/uploads/no_apt_img.png')}}" alt="{{$apartment->title}}">
        </div>
        <div class="card-apt-show-sm card-body card-apt-show-caract col-md-12 col-lg-5 offset-lg-1">
            <h3 class="card-title mb-5">{{$apartment->title}}</h3>
            <h5 class="card-title">Indirizzo</h5>
            <p class="card-text">
                <ul class="list-group">
                <li class="list-group-item">{{$apartment->street}}, {{$apartment->number}}</li>
                <li class="list-group-item">{{$apartment->zip}} {{$apartment->city}}, {{$apartment->state}}</li>
            </ul>
            </p>
        </div>
    </div>

    {{-- descrizione, spazi e servizi --}}
    <div class="row margin-bottom-xl">
        <div class="card-apt-show-sm card-body card-apt-show-caract col-sm-5 col-lg-6">
            <h5 class="card-title">Descrizione:</h5>
            <p class="card-text">{{$apartment->info->summary}}</p>
        </div>

        <div class="margin-bottom-xl card-apt-show-sm card-body card-apt-show-caract col-sm-5 offset-sm-2 col-lg-5 offset-lg-1">
            <div>
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
</div>
@endsection
