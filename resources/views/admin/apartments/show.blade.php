@extends('layouts.app')


@section('content')
  <div class="container">
    <div class="row mb-3">
      <div class="col-sm-12">
        <h1>Dettagli appartamento</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card" style="width: 100%;">

          <img style="width:200px" class="card-img-top" src="{{$apartment->cover_image ? asset('storage/' . $apartment->cover_image) : asset('storage/uploads/unnamed.jpg')}}" alt="Card image cap">
          <div class="card-body">
            <h3 class="card-title">{{$apartment->title}}</h3>
            <p class="card-text">{{$apartment->descrizione_appartamento}}</p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Indirizzo: {{$apartment->indirizzo}}</li>
            <li class="list-group-item">Stanze: {{$apartment->stanze}}</li>
            <li class="list-group-item">Posti letto: {{$apartment->posti_letto}}</li>
            <li class="list-group-item">Bagni: {{$apartment->bagni}}</li>
            <li class="list-group-item">Metri quadri: {{$apartment->sq}}</li>
            <li class="list-group-item">Creato in data: {{$apartment->created_at}}</li>

          </ul>
          <div class="card-body">
            <h5>Servizi</h5>
            <ul class="list-group list-group-flush">
            @forelse ($apartment->services as $service)
                <li class="list-group-item">{{$service->service_name}}</li>
            @empty
                <li class="list-group-item">Non sono presenti servizi.</li>
            @endforelse ($services as $key => $value)
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
