@extends('layouts.view_structure')

{{-- imposto il titolo della pagina --}}
@section('page-title', "BoolBnB - Statistiche")

@section('content')


    <div class="container">
        <div class="row margin-top-xl">
            <div class="col-12">
                <h3 class="d-inline-block col-10 mb-5">Il locale
                    <br>
                    <strong class="green">{{ $apartment->title }}</strong>
                </h3>
                <a class="icon-blue return-button btn btn-primary float-right mb-5" href="{{ route('admin.apartment.index') }}" data-toggle="tooltip" data-placement="bottom"  data-html="true" title="<span class='green-text'>Elenco appartamenti</span>">
                   <i class="fas fa-list-ul fa-2x"></i>
                </a>
                <a class="icon-blue return-button btn btn-primary float-right mb-5" href="{{ url()->previous() }}" data-toggle="tooltip" data-placement="bottom"  data-html="true" title="<span class='green-text'>Indietro</span>">
                   <i class="fas fa-arrow-circle-left fa-2x"></i>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <h4>E' stato visualizzato <strong>{{ $apartment->views }}</strong> volte</h4>
            </div>
        </div>
        <div class="row margin-bottom-xl">
            <div class="col-12">
                <h4>Ha ricevuto <strong>{{ $messages_count }}</strong> richieste<h4>
                {!! $chart->container() !!}
            </div>
        </div>
    </div>
    {!! $chart->script() !!}


@endsection
