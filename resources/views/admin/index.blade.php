 {{-- url: 'admin/apartment'
 nome route: 'admin.apartment.index'
 nome view: 'index' (nella cartella views/admin/)
 controller:  'apartmentController' (nella cartella Controllers\Admin\)
 metodo che la richiama: 'index'  --}}

 {{-- Questa pagina deve visualizzare gli appartamenti dell'utente recuperati dal DB --}}
 {{-- la view riceve infatti un parametro in ingresso (apartment) che rappresenta la collection --}}
 {{-- dei dati letti dal DB (dal metodo ApartmentController@index) --}}
 {{-- Tramite i pulsanti nella colonna Azioni, sarà possibile eseguire delle CRUD sugli appartamenti --}}

 @extends('layouts.view_structure')

 {{-- imposto il titolo della pagina --}}
 @section('page-title', "BoolBnB - I tuoi appartamenti")


 @section('content')
 <div class="container">
    <div class="row margin-top-xl">
        <div class="col-12">
            <h1 class="d-inline-block col-9 mb-5">Tutti i tuoi appartamenti</h1>
            <a class="icon-blue btn btn-primary float-right mb-5" href="{{ route('admin.apartment.create') }}" data-toggle="tooltip" data-placement="bottom"  data-html="true" title="<span class='green-text'>Inserisci un nuovo appartamento</span>">
                {{-- Inserisci nuovo appartamento --}}
                <i class="fas fa-plus fa-2x"></i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table mb-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrizione sintetica</th>
                        <th>Operazioni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($apartments as $apartment)
                    <tr>
                        <td class="{{($apartment->trashed() ? 'trashed_apt' : '')}}"> {{ $apartment->id }}</td>

                        <td class="{{($apartment->trashed() ? 'trashed_apt' : '')}}"> {{ $apartment->title }}</td>

                        <td>
                        @if(!$apartment->trashed())
                            <a id="display_apt" class="sm-margin btn btn-secondary mt-1" href="{{ route('admin.apartment.show', ['apartment' => $apartment->id ]) }}" data-toggle="tooltip" data-placement="top"  data-html="true" title="<span class='green-text'>Visualizza</span>">
                                {{-- Visualizza --}}
                                <i class="far fa-eye fa-lg"></i>
                            </a>
                            <a  id="modify_apt" class="sm-margin btn btn-secondary mt-1" href="{{ route('admin.apartment.edit', ['apartment' => $apartment->id ]) }}" data-toggle="tooltip" data-placement="top"  data-html="true" title="<span class='green-text'>Modifica</span>">
                                {{-- Modifica --}}
                                <i class="fas fa-pen fa-lg"></i>
                            </a>
                            <form class="d-inline-block" action="{{ route('admin.apartment.destroy', ['apartment' => $apartment->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button  id="suspend_apt" class="sm-margin btn btn-secondary mt-1" type="submit" name="button" data-toggle="tooltip" data-placement="top"  data-html="true" title="<span class='green-text'>Sospendi annuncio</span>">
                                    {{-- Sospendi annuncio --}}
                                    <i class="fas fa-pause fa-lg"></i>
                                </button>
                            </form>

                            @if(!in_array( $apartment->id, $active_sponsorships))
                                <a  id="sponsor_apt" class="sm-margin btn btn-secondary mt-1" href="{{ route('admin.apartment.sponsor', ['apartment' => $apartment->id ]) }}" data-toggle="tooltip" data-placement="top"  data-html="true" title="<span class='green-text'>Sponsorizza</span>">
                                    {{-- Sponsorizza --}}
                                    <i class="fas fa-award fa-lg"></i>
                                </a>
                            @else
                                {{-- (c'è una sponsorizzazione attiva per quell'appartamento) --}}
                                {{-- <button id="sponsored_apt" class="sm-margin btn btn-secondary mt-1" data-toggle="tooltip" data-placement="top"  data-html="true" title="<span class='green-text'>Sponsorizzazione già attiva</span>"> --}}
                                <button id="sponsored_apt" class="sm-margin btn btn-secondary mt-1" data-toggle="tooltip" data-placement="right"  data-html="true" title="<span class='green-text'>Sponsorizzazione di tipo <strong>{{ $type_sponsorships[$loop->index] }}</strong> attiva fino a <strong>{{ $end_sponsorships[$loop->index] }}</strong></span>">
                                    <i class="fas fa-award fa-lg"></i>
                                </button>
                            @endif
                            @else
                                <a  id="display_apt"class="suspended sm-margin btn btn-secondary mt-1" href="{{ route('admin.apartment.restore', $apartment->id) }}" data-toggle="tooltip" data-placement="left"  data-html="true" title="<span class='green-text'>Sospespo da <strong>{{ $apartment->deleted_at->locale('it')->isoFormat('dddd, D MMMM YYYY, H:mm') }}</strong>, clicca per riattivare l'annuncio</span>">
                                    {{-- Ripristina --}}
                                    <i class="fas fa-trash-restore-alt fa-lg"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="alert alert-warning" role="alert">
                                Non hai appartamenti nel DB di BoolBnB!
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="margin-bottom-xl d-flex justify-content-center">
                {{-- paginazione fatta automaticamente da Laravel --}}
                {{ $apartments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
