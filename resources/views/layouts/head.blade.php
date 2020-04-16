<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="icon" href="{{ asset('images/team05_favicon.png') }}" type="image/png" />

<!-- Braintree -->
<script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script>

<!-- TomTom -->
<script src="{{ asset('tomtom_sdk/tomtom.min.js') }}"></script>

<!-- ChartJs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
{{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Rubik:400,700&display=swap" rel="stylesheet">

{{-- Media Query --}}
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Fontawesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">

<!-- TomTom -->
<link rel="stylesheet" type="text/css" href="{{ asset('tomtom_sdk/map.css') }}" />

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
