@extends('layouts.app')
@section('content')
<!--Contenido de post-->

<!-- Crear Comentario -->
<div class="background">
  <div class="container">
    <div class="row" id="go">
      <div class="col-md-12">
        <h1 class="maskhos-section-title maskhos-section-section">POST</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2 jumbotron maskhos-alternar">
        <div class="row">
          <div class="col-md-12">
            <h1>{{ $data['post']->postitle }}</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">

            <img src="data:image/jpeg;base64,{{$data['post']->posphoto}}" />

          </div>
        </div><div class="row">
          <div class="col-md-12">
            {{ $data['post']->poscontent }}
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default maskhos-form">
          <form class="form-horizontal maskhos-form" role="form" method="POST" action="{{ url('/blog/comment') }}">
            <legend class="text-center"><span class="number">1</span>Crear Comentario</legend>
            <fieldset>
              {!! csrf_field() !!}
              <div class="form-group{{ $errors->has('usdesc') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Respuesta.</label>

                <div class="col-md-6">
                  <div class="maskhos-pro-div">
                    <textarea class="form-control maskhos-z-input" name="comcontent"></textarea>
                  </div>

                  @if ($errors->has('usdesc'))
                  <span class="help-block">
                    <strong>{{ $errors->first('usdesc') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn maskhos-btn-primary">
                    <i class="fa fa-btn fa-pencil"></i>Post Comment
                  </button>
                </div>
              </div>
            </fieldset>

          </form>

        </div>
      </div>
    </div>
    @foreach ($data['comments'] as $comments)
    <div class="row">
      <div class="col-md-8 col-md-offset-2 jumbotron img-rounded">

        @foreach ($data['users'] as $users)
        @if ($users->id == $comments->user_id)
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-10">
              <h2>{{ $users->usname }}</h2>

            </div>
            <div class="col-md-1">
              <img width="50px" height="50px" class="img-rounded" src="data:image/jpeg;base64,{{ $users->uspicture }}" />

            </div>
            @if($users->id == Auth::id())
            <div class="col-md-1">
              <a class="btn-xs btn-danger fa fa-pencil"  href="{{ url('/blog/'. $data['id'] . '/' . $comments->id) }}" ></a>
            </div>
            @endif
          </div>

        </div>

        @endif



        @endforeach
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6">
              {{ $comments->comcontent }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
</div>


@endsection
