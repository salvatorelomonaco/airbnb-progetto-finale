<nav id="header_nav" class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="logo-link d-inline-block navbar-brand" href="{{ route('public') }}">
            {{-- {{ config('app.name', 'Boolbnb') }} --}}
            <img class="logo" src="{{ asset('images/team05_logo.png') }}" alt="logo team05">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li>
                        <a class="nav-link {{ Route::currentRouteName() == 'admin.home' ? 'active' : '' }}"  href="{{ route('admin.home') }}">Pannello di controllo</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.account') }}">Profilo</a>
                            {{-- <a class="dropdown-item" href="{{ route('admin.apartment.create') }}">Nuovo appartamento</a> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li>
                        <a class="btn-edit return-button btn btn-primary float-right icon-blue" href="{{ route('public') }}" data-toggle="tooltip" data-placement="bottom"  data-html="true" title="<span class='green-text'>Homepage</span>">
                            {{-- homepage --}}
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
