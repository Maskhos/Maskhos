@extends('layouts.app')

@section('content')
<div class="background">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="col-md-12 maskhos-section-title maskhos-section-section">
          Mostrar Usuario
        </h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2 jumbotron img-rounded">


        <div class="row">
          <div class="col-md-12">
            <div class="col-md-10">
              {{$data['user']->usname}}
            </div>
            <div class="col-md-1">
              <img width="50px" height="50px" class="img-rounded" src="data:image/jpeg;base64,{{ $data['user']->uspicture }}" />

            </div>


          </div>

        </div>
      </div>
      @endsection
