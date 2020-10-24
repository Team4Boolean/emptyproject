@extends('layouts.app')
@section('content')

{{-- CREAZIONE APPARTAMENTO --}}

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                {{-- Titolo pagina cardheader --}}
                  <div class="card-header">
                    <h1>Pubblica il tuo appartamento:</h1>
                  </div>
                  <div class="card-body">

                    @include('partials.input-errors')

                    {{-- FORM --}}
                    <form class="flat-create" action="{{ route('flats.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      @method('POST')

                      <div class="form-row">
                        {{-- INPUT DI TESTO --}}
                        <section class="textInput col-lg-7 col-md-6">
                          {{-- Titolo --}}
                          <div id="input-title" class="input-group">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="title"><h6>Titolo</h6></label>
                            </div>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') }}">
                            @error('title')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          {{-- Descrizione --}}
                          <div id="input-desc" class="form-group">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="desc"><h6>Descrizione</h6></label>
                            </div>
                            <textarea class="form-control" name="desc" rows="8" cols="80">{{ old('desc') }}</textarea>
                          </div>
                        </section>

                        {{-- INPUT NUMERICI --}}
                        <section class="numInput  offset-md-1 col-lg-4 col-md-5 pt-4">
                          {{-- n* Stanze --}}
                          <div class="input-group mb-4">
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
                          {{-- n* letti --}}
                          <div class="input-group mb-4">
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
                          {{-- n* Bagni --}}
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="baths">Bagni</label>
                            </div>
                            <select class="custom-select" name="baths">
                              <option selected>Scegli...</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                            </select>
                          </div>
                          {{-- metri quadri --}}
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <label class="input-group-text" for="sqm">Size</label>
                            </div>
                            <input class="form-control" type="number" name="sqm" value="{{ old('sqm') }}">
                            <div class="input-group-prepend">
                              <label class="input-group-text radius" for="sqm">m²</label>
                            </div>
                          </div>
                        </section>
                      </div>

                        {{-- ADDRESS --}}
                        <section class="addressInput">
                          <div class="sec-title mx-auto m-3">
                            <h5>Indirizzo</h5>
                          </div>
                          <div class="adrInpList">
                            <div class="form-row mb-4">
                              {{-- street name --}}
                              <div class="input-group input-group-md col-md-8">
                                <input type="text" id="street_name" class="form-control add_input" name="street_name" value="{{old('street_name')}}" placeholder="Via ...">
                              </div>
                              {{-- street number --}}
                              <div class="input-group input-group-md col-md-4">
                                <input type="text" id="street_number" class="form-control add_input" name="street_number" value="{{old('street_number')}}" placeholder="n°">
                              </div>
                            </div>
                            <div class="form-row  mb-4">
                              {{-- province --}}
                              <div class="input-group input-group-md col-md-5">
                                <input type="text" id="subdivision" class="form-control add_input" name="subdivision" value="{{old('subdivision')}}" placeholder="Provincia">
                              </div>
                              {{-- municipality --}}
                              <div class="input-group input-group-md col-md-5 mb-3">
                                <input type="text" id="municipality" class="form-control add_input" name="municipality" value="{{old('municipality')}}" placeholder="Città">
                              </div>
                              {{-- cap --}}
                              <div class="input-group input-group-md col-md-2">
                                <input type="text" id="postal_code" class="form-control add_input" name="postal_code" value="{{old('postal_code')}}" placeholder="cap">
                              </div>
                            </div>

                            {{-- latitudine/longitudine nascosti --}}
                            <div class="form-group" style="display:none">
                              <label for="lon">LONGITUDINE</label>
                              <br>
                              <input id="lon" type="text" name="lon" value="">
                            </div>
                            <div class="form-group" style="display:none">
                              <label for="lat">LATITUDINE</label>
                              <br>
                              <input id="lat" type="text" name="lat" value="">
                            </div>
                          </div>
                        </section>


                      {{-- INPUT SERVIZI (checkbox) --}}

                      <section class="checkInput">
                        <div class="form-group">
                          <div class="sec-title mx-auto m-3">
                            <h5>Servizi</h5>
                          </div>
                          <div class="form-row m-4">
                            <div class="serv-list col">
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="services[]" value="wifi" class="custom-control-input" id="defaultInline1">
                                <label class="custom-control-label" for="defaultInline1">Wifi</label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="services[]" value="parcheggio" class="custom-control-input" id="defaultInline2">
                                <label class="custom-control-label" for="defaultInline2">Parcheggio</label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="services[]" value="swim" class="custom-control-input" id="defaultInline3">
                                <label class="custom-control-label" for="defaultInline3">Piscina</label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="services[]" value="concierge" class="custom-control-input" id="defaultInline4">
                                <label class="custom-control-label" for="defaultInline4">Portinaio</label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="services[]" value="sauna" class="custom-control-input" id="defaultInline5">
                                <label class="custom-control-label" for="defaultInline5">Sauna</label>
                              </div>
                              <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="services[]" value="sea" class="custom-control-input" id="defaultInline6">
                                <label class="custom-control-label" for="defaultInline6">Vista Mare</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>

                      {{-- INPUT IMMAGINE --}}


                      <section class="imgInput">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <label class="input-group-text" for="img">Immagine dell'appartamento</label>
                          </div>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img" id="imgInp" aria-describedby="inputGroupFileAddon01" >
                            <label class="custom-file-label" for="img" >Scegli file</label>
                          </div>
                        </div>
                        <div id="prevContainer" class="img-container" style="text-align:center; display:none;" >
                          <img id="prev" src="#" class="img-thumbnail">
                        </div>
                      </section>

                      {{-- btn group --}}

                      <section class="btnInput">
                        <a href="{{ route('home') }}"><i class="fas fa-arrow-circle-left"></i></a>
                        <button class="btn btn-primary" type="submit">Conferma</button>
                      </section>

                    </form>
                    {{-- <section id="ImgInput" style="padding-top:90px; text-align:center;">
                      <div class="row">
                        <div class="col-md-12">
                          {{-- <form method="POST" action="{{route('dropzone.store')}}" accept-charset="UTF-8" enctype="multipart/form-data" class="dropzone dz-clickable" id="image-upload">
                            @csrf
                            <div>
                              <h3>Carica le immagini del tuo appartamento</h3>
                            </div>
                            <div class="dz-default dz-message">
                              <span>
                                Trascina le immagini qui per caricarle
                              </span>
                            </div>
                          </form> --}}
                          {{-- <div class='content'>
                            <!-- Dropzone -->
                            <form action="{{route('dropzone.store')}}" class='dropzone' id="dropzone" >

                            </form>
                          </div> --}}
                          {{-- <vue-dropzone
                          ref="myVueDropzone" id="dropzone" :
                          options="dropzoneOptions">
                        </vue-dropzone> --}}
                        </div>
                      </div>
                    </section>
                  </div>
              </div>
          </div>
      </div>
  </div>






@endsection
