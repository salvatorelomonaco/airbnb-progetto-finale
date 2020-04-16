@extends('layouts.view_structure')

{{-- imposto il titolo della pagina --}}
@section('page-title', "BoolBnB")


@section('content')
    <div class="d-flex">
        <div class="d-flex left-green">
            <img class="sad" src="{{ asset('storage/background/sad.png')}}" alt="sad face">
        </div>
        <div class="right-blue d-flex">
            <div class="content-blue-box text-center">
                <p class="error-404"><strong>404</strong></p>
                <p>page not found!!</p>
                <a class="btn error-return" href="{{ route('public') }}">Torna in Homepage</a>

            </div>
        </div>
    </div>
@endsection
