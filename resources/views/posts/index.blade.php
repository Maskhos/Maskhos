@extends('layouts.app')
@section('content')
<div class="container">
  <div class="background">
    <div class="container">
      <div class="row" id="go">
        <div class="col-md-12">
          <h1 class="maskhos-section-title maskhos-section-section">POST</h1>
        </div>
      </div>
      @foreach($data['post'] as $post)
      <div class="row">
        <div class="col-md-8 col-md-offset-2 jumbotron">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-6">
                @foreach($data['user'] as $user)
                @if($user->id == $post->user_id)
                <div class="col-md-12">
                  <label class="label-info label">Escrito por  {{$user->usname}}</label>
                </div>
                <div class="col-md-12">
                  <img   width="50px" height="50px" class="img-rounded img-responsive" src="data:image/jpeg;base64,{{$user->uspicture}}" />
                </div>
                @endif
                @endforeach
              </div>
              <div class="col-md-6">
                <h1><a href="{{ url('/post/'.$post->id) }}"><h1>{{ $post->postitle }}</h1></a>
              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-6">
              </div>
              <div class="col-md-6">
                <img  class="img img-responsive" src="data:image/jpeg;base64,{{$post->posphoto}}" />

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              {{ $post->poscontent }}
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endsection
