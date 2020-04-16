@extends('layouts.view_structure')

{{-- imposto il titolo della pagina --}}
@section('page-title', "BoolBnB - Il tuo profilo")


@section('content')
<div class="container margin-top-xl margin-bottom-xl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-5">Il tuo profilo</h1>
            <div class="card">
                <div class="card-header">Ciao <strong class="green h5">{{ Auth::user()->name }}</strong> !</div>

                <div class="card-body">
                    <h3>Ecco i tuoi dettagli:</h3>
                    <ul>
                        <li>Nome: <strong>{{ $user_details->name }}</strong></li>
                        <li>Cognome: <strong>{{ $user_details->lastname }}</strong></li>
                        <li>Data di nascita: <strong>{{ $date_of_birth }}</strong></li>
                        <li>E-mail di autenticazione: <strong>{{ $user_details->email }}</strong></li>
                        <li>Registrato dal: <strong>{{ $reg_date }}</strong></li>
                        {{-- <li>{{ $days_to_birthday }}</li> --}}

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
