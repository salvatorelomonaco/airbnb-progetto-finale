@extends('layouts.view_structure')

{{-- imposto il titolo della pagina --}}
@section('page-title', "BoolBnB - Pannello di controllo")


@section('content')
<div class="bckg-container">
    <div class="container">
        <div class="control-panel row justify-content-center">
            <div class="col-md-8 d-flex">
                <div class="text-center card blk-container m-auto">

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2 class="wht">Benvenuto <strong>{{ Auth::user()->name }}</strong>! </h2>
                        <p class="wht">
                            Ti sei autenticato con la seguente e-mail:
                            <strong class="green">{{ Auth::user()->email }}</strong>
                        </p>
                        <div class="btn-container">
                            <p class="wht">Cosa puoi fare:</p>
                            <div>
                                <a class="btn eye" href="{{ route('admin.apartment.index') }}" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<span class='green-text'>visualizza i tuoi appartamenti</span>">
                                    {{-- Visualizza i tuoi appartamenti --}}
                                    <i class="far fa-eye fa-2x"></i>
                                </a>
                                <a class="btn add" href="{{ route('admin.apartment.create') }}" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<span class='green-text'>inserisci un nuovo appartamento</span>">
                                    {{-- Inserisci nuovi appartamenti --}}
                                    <i class="fas fa-plus fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
