@extends('layouts.view_structure')

{{-- imposto il titolo della pagina --}}
@section('page-title', "BoolBnB - Utente non autorizzato")


@section('content')
<div class="container">
    <div class="row justify-content-center margin-top-xl margin-bottom-xl">
        <div class="col-md-8">
            <h1 class="d-inline-block col-9 mb-3">OPERAZIONE NON AUTORIZZATA!</h1>
            <a class="icon-blue return-button btn btn-primary float-right mb-5" href="{{ route('admin.apartment.index') }}" data-toggle="tooltip" data-placement="bottom"  data-html="true" title="<span class='green-text'>Elenco appartamenti</span>">
               <i class="fas fa-list-ul fa-2x"></i>
            </a>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong class="green h5">{{ Auth::user()->name }}</strong> non hai i permessi per eseguire l'operazione</div>

                <div class="card-body">
                    <h3>Dettagli:</h3>
                    <p>Se visualizzi questa pagina, vuol dire che è stato fatto un tentativo di accedere ad una pagina o eseguire un'operazione non autorizzata.
                    Contatta l'amministrtore del sito per ulteriori dettagli.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
