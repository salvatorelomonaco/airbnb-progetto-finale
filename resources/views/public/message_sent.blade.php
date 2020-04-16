@extends('layouts.view_structure')

{{-- imposto il titolo della pagina --}}
@section('page-title', "BoolBnB - Messaggio inviato")


@section('content')
<div class="container">


    <div class="container">
        <div class="row justify-content-center margin-top-xl margin-bottom-xl">
            <div class="col-md-8 clearfix">
                <h1 class="d-inline-block col-7 mb-5">MESSAGGIO INVIATO!</h1>
                <a class="btn-edit return-button btn btn-primary float-right mb-5 icon-blue" href="{{ url()->previous() }}" data-toggle="tooltip" data-placement="bottom"  data-html="true" title="<span class='green-text'>Indietro</span>">
                    {{-- back --}}
                    <i class="fas fa-arrow-circle-left fa-2x"></i>
                </a>
            </div>
            <div class="card">
                <div class="card-header">
                    <strong>
                        Il proprietario dell'appartamento ha ricevuto la tua richiesta di informazioni.
                    </strong>
                </div>
                <div class="card-body">
                    <p>La tua richiesta per:
                        <strong>
                            {{$apartment->title}}
                        </strong>
                    </p>
                    <p>
                        Questo è il testo del messaggio che hai inviato: "<em>{{ $new_message->message }}</em>"
                        {{-- {{ $new_message->created_at }} --}}
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
