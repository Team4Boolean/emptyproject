@extends('layouts.search-app')
@section('jumbo')


<div class="flatsearch" style="background-image: url('https://a0.muscache.com/pictures/18084f37-67e0-400f-bfd8-55eea0e89508.jpg')">
  <div class="jumbo-navbar">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img id="jumbo-img-logo" src="{{asset('imgs/airbnb.svg')}}" width="40px" height="auto" alt="logo">
      <span class="jumbo-span-logo">Boolbnb</span>
    </a>
    <div class="col-xs-12 col-md-6 col-lg-4 ">
      <ul>
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('flats.create') }}">Affitta un appartamento</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('flats.index') }}">Area personale</a>
          </li>
        @endguest

        {{-- Dropdown --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bars"></i>
            {{-- If the user is logged shows his firstname --}}
            @guest
              <i class="fas fa-user"></i>
            @else
              <span>{{ Auth::user()->firstname }}</span>
            @endguest
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            {{-- If the user is a guest, he can login/register --}}
            @guest
              <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
              <a class="dropdown-item" href="{{ route('register') }}">{{ __('Registrati') }}</a>
            {{-- If he is already logged he can logout --}}
            @else
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            @endguest

            {{-- <div class="dropdown-divider"></div> --}}

            {{-- Other links --}}
            {{-- <a class="dropdown-item" href="{{ route('flats.create') }}">Affitta un appartamento</a> --}}
            {{-- <a class="dropdown-item" href="#">Proponi un'esperienza</a>
            <a class="dropdown-item" href="#">Assistenza</a> --}}
          </div>
        </li>
      </ul>
    </div>
  </div>

{{-- ------SEARCH CONTAINER---- --}}

<div class="container" >
  <div class="wrapper">
    <div class="row ">
      {{-- LEFT-SIDE --}}
      <div class="col-lg-6 col-xl-4 left-side mb-3">
      <h1>{{ $loc }}:</h1>

      <form action="{{ route('api.flats.search') }}" method="get">
        @csrf
        @method('GET')
        <input id="jumbo-search-bar" class="jumbo-search-bar" type="search" name="loc" value="{{ $loc }}" placeholder="Cambia la meta..">
          <div class="form-group" style="display:none">
              <label for="lon">LONGITUDINE</label>
              <br>
              <input id="jumbo-search-lon" type="text" name="lon" value="">
          </div>
          <div class="form-group" style="display:none">
              <label for="lat">LATITUDINE</label>
              <br>
              <input id="jumbo-search-lat" type="text" name="lat" value="">
          </div>
        <hr>

          <section class="numInput ">
            <div class="input-group mb-3">
              <div class="input-group-prepend ">
                <label for="selectDistance" class="input-group-text ">Scegli la distanza</label>
              </div>
              <select class="selectDistance custom-select" name="distance">
                <option selected>Scegli...</option>
                <option value="5">Entro 5 Km</option>
                <option value="10">Entro 10 Km</option>
                <option value="25">Entro 25 Km</option>
              </select>
            </div>
            <div class="d-flex justify-content-between mb-3 flex-wrap">
              <div class="input-group col-6">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="rooms">Stanze</label>
                </div>
                <select class="custom-select" name="rooms">
                  <option selected>Scegli...</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
              <div class="input-group col-6">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="beds">Letti</label>
                </div>
                <select class="custom-select" name="beds">
                  <option selected>Scegli...</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="3">4</option>
                  <option value="3">5</option>
                </select>
              </div>
            </div>
          </section>
          <hr>
          <section class="checkInput ">
            <div class="form-group">
              <ul class=" list-unstyled">
                <div class="row ">
                  <li class="col-6">
                    <label><input type="checkbox" name="services[]" value="1"
                      {{ (is_array(old('services')) and in_array(1, old('services'))) ? ' checked' : '' }}
                      > Wifi</label>
                  </li>
                  <li class="col-6 ">
                    <label><input type="checkbox" name="services[]" value="2"
                      {{ (is_array(old('services')) and in_array(2, old('services'))) ? ' checked' : '' }}
                      > Parcheggio</label>
                  </li>
                </div>
                <div class="row ">
                  <li class="col-6">
                    <label><input type="checkbox" name="services[]" value="3"
                      {{ (is_array(old('services')) and in_array(3, old('services'))) ? ' checked' : '' }}
                      > Piscina</label>
                  </li>
                  <li class="col-6 " >
                    <label><input type="checkbox" name="services[]" value="4"
                      {{ (is_array(old('services')) and in_array(4, old('services'))) ? ' checked' : '' }}
                      > Portinaio</label>
                  </li>
                </div>
                <div class="row ">
                  <li class="col-6">
                    <label><input type="checkbox" name="services[]" value="5"
                      {{ (is_array(old('services')) and in_array(5, old('services'))) ? ' checked' : '' }}
                      > Sauna</label>
                  </li>
                    <li class="col-6">
                      <label><input type="checkbox" name="services[]" value="6"
                        {{ (is_array(old('services')) and in_array(6, old('services'))) ? ' checked' : '' }}
                        > Vista Mare</label>
                    </li>
                </div>
              </ul>
            </div>
          </section>
          <button type="submit" class="btn">Cerca</button>
        </form>
      </div>
      {{-- RIGHT SIDE --}}
      <div class="col-lg-6 col-xl-8 right-side">

          <script type="text/javascript">

            function initVue() {
              const search = new Vue({
                el: '#search',
              });
            }

            function init() {
              initVue();
            }

            $(document).ready(init);

          </script>

          <div id="search" class="container" >
            <div class="right-side-title">
              <h2>RISULTATI</h2>
            </div>
            <hr>
            <div class="row">

              @isset($flats)
                @foreach ($flats as $flat)

                <flatcomponent
                :title = "'{{ $flat -> title }}'"
                :desc = "'{{ $flat -> desc }}'"
                :img = "'{{ asset($flat -> photos() -> first() -> path) }}'"
                :id = "'{{ $flat -> id }}'"
                ></flatcomponent>

                @endforeach
                @else
                <h3 class="text-danger">Non sono presenti risultati.</h3>
              @endisset

            </div>

          </div>
          {{-- /div id=search --}}


        {{-- /container --}}

      </div>
      {{-- <a id="back-btn" class="btn btn-primary" href="{{route('flats.index')}}">Indietro</a> --}}
    </div>
  </div>

</div>

</div>
@endsection
