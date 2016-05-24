@extends('layouts.app')
@section('content')
<div class="background">
  <div class="container">
    <div class="row" id="go">
      <div class="col-md-12">
        <h1 class="maskhos-section-title maskhos-section-section">Editar Comentario </h1>
      </div>
    </div>
    <form class="form-horizontal maskhos-form" role="form" method="POST" action="{{ url('/blog/updateComment') }}">
      <legend class="text-center"><span class="number">1</span>Editar Comentario</legend>
      <fieldset>
        {!! csrf_field() !!}
        <div class="form-group{{ $errors->has('usdesc') ? ' has-error' : '' }}">
          <label class="col-md-4 control-label">Respuesta.</label>


          <div class="col-md-6">
            <div class="maskhos-pro-div">
              <textarea class="form-control maskhos-z-input" name="comcontent"  >{{$data['comments']->comcontent }}</textarea>
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
              <i class="fa fa-btn fa-pencil"></i>Editar Comentario
            </button>
          </div>
        </div>
      </fieldset>

    </form>
  </div>
</div>
@endsection
