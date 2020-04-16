@extends('layouts.view_structure')

{{-- imposto il titolo della pagina --}}
@section('page-title', "BoolBnB - Aggiungi una sponsorizzazione al tuo appartamento")


@section('content')
<div class="container">

    <h1 class="margin-top-xl">Inserisci una sponsorizzazione</h1>

    <p>{{ $apartment->title }}</p>


    <div class="row apt-show-row">
        <div class="card-body">
            <h5 class="card-title">Seleziona la sponsorizzazione:</h5>
            <div class="card-text">
                <form class="w-100" method="post" action="{{ route('admin.payment.make', ['apartment' => $apartment->id ] ) }}">
                    @csrf
                    @foreach ($sponsorships as $sponsorship)

                        <label for="sponsor_{{ $sponsorship->id }}">

                        <input id="sponsor_{{ $sponsorship->id }}" type="radio" name="sponsorship_id" value="{{ $sponsorship->id }}" {{$loop->first ? "checked" : ""}} >
                            {{ $sponsorship->type }} - {{ $sponsorship->price }} € per {{ $sponsorship->hours }} ore di sponsorizzazione!
                        </label>
                        <br>
                    @endforeach

                    <div class="container">
                        <div class="row">
                            <div class="margin-bottom-xl col-md-8 col-md-offset-2">
                                <div id="dropin-container"></div>
                                <button type="button" id="submit-button">Request payment method</button>
                                <button class="d-none" type="submit" id="payment-button">Paga</button>
                            </div>
                        </div>
                    </div>
                </form>

               <script>
                    var button = document.querySelector('#submit-button');

                    braintree.dropin.create({

                        authorization: '{{ Braintree_ClientToken::generate() }}',

                        container: '#dropin-container'

                        },
                        function (createErr, instance) {

                            $('#submit-button').click(function () {
                                $(this).hide(); // nascondo bottoncino "Request"
                                $("#payment-button").removeClass('d-none').addClass('d-block'); // faccio apparire il pulsante "Paga"
                                instance.requestPaymentMethod(function (err, payload) {
                                    $.get('{{ route("admin.payment.make",  ["apartment" => $apartment->id] ) }}', {payload}, function (response) {
                                        if (response.success) {
                                            alert('Payment successfull!');
                                        } else {
                                            alert('Payment failed');
                                        }
                                    }, 'json');
                                });
                            });
                    });
                </script>
           </div>
        </div>
    </div>
</div>
@endsection
