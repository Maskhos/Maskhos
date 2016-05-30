@extends('layouts.app')
@section('content')
<!--Contenido de post-->

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 maskhos-section-title maskhos-section-character">
			Ver Post
		</div>
	</div>
<div class="container">
	<div class="row maskhos-transparency">
		<div class="maskhos-entry-image col-md-12" style="background-image:url('data:image/png;base64,{{$data['post']->posphoto}}');">

		</div>
	</div>

    <!-- EMPIEZA FORM-->
    @if(Auth::user() !=null)
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
    </div><!--ACABA CREAR COMENTARIO -->
    @endif
    <h1>Comentarios</h1>
    @foreach ($data['post']->comments as $comments)
    <div class="row">
      <div class="col-md-8 col-md-offset-2 jumbotron img-rounded">


        <div class="row">
          <div class="col-md-12">
            <div class="col-md-10">
              <a href="{{url('showuser/'.$data['post']->users->id.'')}}"> <h2>{{ $data['post']->users->usname }}</h2></a>

            </div>
            <div class="col-md-1">
              <img width="50px" height="50px" class="img-rounded" src="data:image/jpeg;base64,{{ $data['post']->users->uspicture }}" />

            </div>
            @if($data['post']->users->id == Auth::id())
            <div class="col-md-1">
              <a class="btn-xs btn-danger fa fa-pencil"  href="{{ url('/blog/'. $data['id'] . '/' . $comments->id) }}" ></a>
            </div>
            @endif
          </div>

        </div>
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
@endsection
