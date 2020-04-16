@extends('layouts.view_structure')

{{-- imposto il titolo della pagina --}}
@section('page-title', "BoolBnB - Pagamento sponsorizzazione ok")


@section('content')
<div class="container">
    <div class="row display-flex margin-top-xl">
        <div class="col-12">
            <h1 class="title-checkout col-md-10 d-inline-block mb-4">Complimenti, pagamento effettuato</h1>
            <a class="icon-blue show-btn btn btn-primary float-right mb-4" href="{{ route('admin.apartment.index') }}" data-toggle="tooltip"data-html="true" data-placement="bottom" data-html="true" title="<span class='green-text'>Elenco appartamenti</span>">
                {{-- Elenco appartamenti --}}
                <i class="fas fa-list-ul fa-2x"></i>
            </a>
        </div>
    </div>

    <p class="margin-bottom-xl">Il tuo appartamento <strong>{{ $apartment->title}}</strong> è ora sponsorizzato e apparirà in evidenza.</p>
</div>
@endsection
