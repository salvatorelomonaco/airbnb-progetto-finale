@extends('layouts.view_structure')

{{-- imposto il titolo della pagina --}}
@section('page-title', "BoolBnB - Elenco richieste")

@section('content')
    <div class="container">
       <div class="row margin-top-xl">
           <div class="col-12">
               <h3 class="d-inline-block mb-5">Elenco richieste per
                    <br>
                    <strong>{{ $apartment->title }}</strong>
                </h3>
                <a class="icon-blue return-button btn btn-primary float-right mb-5" href="{{ route('admin.apartment.index') }}" data-toggle="tooltip" data-placement="bottom"  data-html="true" title="<span class='green-text'>Elenco appartamenti</span>">
                    {{-- I tuoi appartamenti --}}
                    <i class="fas fa-list-ul fa-2x"></i>
                </a>
                <a class="icon-blue return-button btn btn-primary float-right mb-5" href="{{ url()->previous() }}" data-toggle="tooltip" data-placement="bottom"  data-html="true" title="<span class='green-text'>Indietro</span>">
                   <i class="fas fa-arrow-circle-left fa-2x"></i>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table margin-bottom-xl">
                    <thead>
                        <tr>
                            <th>E-mail</th>
                            <th>Testo messaggio</th>
                            <th>Ricevuto il</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $message)
                        <tr>
                            <td>{{ $message->email }}</td>

                            <td>{{ $message->message }}</td>

                            <td>{{ $message->created_at }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-warning" role="alert">
                                    Non hai ricevuto nessuna richiesta per questo appartamento
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- paginazione fatta automaticamente da Laravel --}}
        {{ $messages->links() }}

    </div>
@endsection
