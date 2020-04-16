{{-- MOCKUP 2 --}}

@extends('layouts.view_structure')

{{-- imposto il titolo della pagina --}}
@section('page-title', "BoolBnB - Ricerca appartamento")


@section('content')
    <div class="container">
        {{-- <div class="white-form-container"> --}}
            <div class="flex margin-bottom-xl">
                <h1 class="display-5 mb-5 mt-5">Risultati ricerca su: <strong>{{ $place }}</strong></h1>
                    {{-- <div class="form-group">
                        <label for="exampleInputEmail1">
                            <h5>Località ricercata:</h5>
                        </label>
                        <input type="text" class="form-control" value="{{ $place }}">
                    </div> --}}

                @foreach($apts_sponsor as $apt_sponsor)
                    @break($loop->index > 1)
                    <a class="apt-card mb-3" href="{{ route('public.show', [$apt_sponsor->id]) }}">
                        <div class="card sponsor mb-3 on-hover">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{$apt_sponsor->info->image ? asset('storage/' . $apt_sponsor->info->image) : asset('storage/uploads/no_apt_img.png')}}" alt="{{$apt_sponsor->title}}" class="card-img p-2">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body module line-clamp">
                                        <h5 class="card-title d-inline-block"><strong>{{ $apt_sponsor->city }}</strong></h5>
                                        <span class="neon-sponsor float-right h6"><strong>IN EVIDENZA</strong></span>
                                        <p class="card-text"><strong>{{ $apt_sponsor->title }}</strong></p>
                                        <p class="card-text ellips">{{ $apt_sponsor->info->summary }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

                @forelse ($nearby_apts as $nearby_apt)
                    <a class="apt-card" href="{{ route('public.show', $nearby_apt->id) }}">
                    <div class="card mb-3 on-hover">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{$nearby_apt->info->image ? asset('storage/' . $nearby_apt->info->image) : asset('storage/uploads/no_apt_img.png')}}" alt="{{$nearby_apt->title}}" class="card-img p-2">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body module line-clamp">
                                        <h5 class="card-title d-inline-block"><strong>{{ $nearby_apt->city }}</strong></h5>
                                        <span class="float-right h6 a-km blue-text">
                                            <strong>a {{ number_format(($apts_id_dist[$nearby_apt->id]/1000), 2) }} km</strong>
                                        </span>
                                        <p class="card-text"><strong>{{ $nearby_apt->title }}</strong></p>
                                        <p class="card-text ellips">{{ $nearby_apt->info->summary }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="alert alert-warning" role="alert">
                        Non ci sono risultati corrispondenti alla tua ricerca!
                    </div>

                @endforelse

                {{-- <h3>Raffina la tua ricerca</h3> --}}

                {{-- <form>
                    <div class="form-group">
                        <label for="distance">Raggio di ricerca(km):</label>
                        <input type="number" name="distance" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="beds">N. letti:</label>
                        <input type="number" name="beds" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="rooms">N. Stanze:</label>
                        <input type="number" name="rooms" class="form-control">
                    </div>

                    <p>Seleziona i servizi:</p>
                    <div class="form-inline">
                        <div class="frm-search form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="service" value="service">
                            <label class="form-check-label" for="service">
                                Wi-fi
                            </label>
                        </div>
                        <div class="frm-search form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="service" value="service">
                            <label class="form-check-label" for="service">
                                Swimming pool
                            </label>
                        </div>
                        <div class="frm-search form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="service" value="service">
                            <label class="form-check-label" for="service">
                                Reception
                            </label>
                        </div>
                        <div class="frm-search form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="service" value="service">
                            <label class="form-check-label" for="service">
                                Sauna
                            </label>
                        </div>
                        <div class="frm-search form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="service" value="service">
                            <label class="form-check-label" for="service">
                                Sea view
                            </label>
                        </div>
                        <div class="frm-search form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="service" value="service">
                            <label class="form-check-label" for="service">
                                Parking
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn bckg-green wht research mb-5">Cerca</button>
                </form> --}}

            </div>
        {{-- </div> --}}
    </div>
@endsection
