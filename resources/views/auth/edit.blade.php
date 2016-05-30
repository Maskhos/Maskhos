@extends('layouts.app')

@section('content')
<div class="background">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 maskhos-section-title maskhos-section-section">
			Editar usuario
		</div>
	</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default maskhos-form">
				<form  enctype="multipart/form-data"  class="form-horizontal maskhos-form" role="form" method="POST" action="{{ url('/updateuser') }}">
					<legend class="text-center"><span class="number">1</span>Datos personales</legend>
					<fieldset>
						{!! csrf_field() !!}
						<div class="form-group{{ $errors->has('usname') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Nombre</label>
				<div class="col-md-6">
								<div class="maskhos-pro-div"><input type="text" class="form-control maskhos-z-input" name="usname" value="{{ $data['user']->usname}}" ></div>

								@if ($errors->has('usname'))
									<span class="help-block">
										<strong>{{ $errors->first('usname') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">E-Mail</label>

							<div class="col-md-6">
								<div class="maskhos-pro-div"><input type="email" class="form-control maskhos-z-input" name="email" value="{{ $data['user']->email}}"></div>

								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('usbirthDate') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Fecha de nacimiento</label>

							<div class="col-md-6">
								<div class="maskhos-pro-div"><input type="date" class="form-control maskhos-z-input" name="usbirthDate" value="{{ $data['user']->usbirthDate}}"></div>

								@if ($errors->has('usbirthDate'))
									<span class="help-block">
										<strong>{{ $errors->first('usbirthDate') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">¿De qué país eres?</label>

							<div class="col-md-6">
								<div class="maskhos-pro-div"><select class="form-control maskhos-z-input-select" name="country">
									@foreach ($data['countrys'] as $country)
									@if($country->id == $data['user']->country_id)
										<option selected  value="{{ $country->id }}">{{ $country->couname }}</option>

									@else
										<option value="{{ $country->id }}">{{ $country->couname }}</option>
									@endif

									@endforeach
								</select></div>

								@if ($errors->has('country'))
									<span class="help-block">
										<strong>{{ $errors->first('country') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('usdesc') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Escribe una pequeña biografía sobre ti.</label>

							<div class="col-md-6">
								<div class="maskhos-pro-div">
                  <textarea class="form-control maskhos-z-input" name="usdesc" value="{{ $data['user']->usdesc}}">
                </textarea></div>

								@if ($errors->has('usdesc'))
									<span class="help-block">
										<strong>{{ $errors->first('usdesc') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('usepicture') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Cambiar foto portada</label>

							<div class="col-md-6">
								<div class="maskhos-pro-div">

                  <input type="file" class="form-control maskhos-z-input" name="uspicture"  />

                </div>

								@if ($errors->has('usepicture'))
									<span class="help-block">
										<strong>{{ $errors->first('usepicture') }}</strong>
									</span>
								@endif
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend class="text-center"><span class="number">2</span>¡¿Cuál es tu facción?!</legend>
						<div class="form-group{{ $errors->has('faction') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Elige</label>

							<div class="col-md-6">
								<div class="maskhos-pro-div"><select class="form-control maskhos-z-input-select" name="faction">
									@foreach ($data['factions'] as $faction)
									@if($faction->id == $data['user']->faction_id)
										<option  selected value="{{ $faction->id }}">{{ $faction->facname }}</option>

									@else
										<option value="{{ $faction->id }}">{{ $faction->facname }}</option>
									@endif
									@endforeach
								</select></div>

								@if ($errors->has('faction'))
									<span class="help-block">
										<strong>{{ $errors->first('faction') }}</strong>
									</span>
								@endif
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend class="text-center"><span class="number">3</span>Social</legend>
						<div class="form-group{{ $errors->has('ustwitter') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Twitter</label>
							<div class="col-md-6">
								<div class="maskhos-pro-div"><input type="text" class="form-control maskhos-z-input" name="ustwitter" value="{{ $data['user']->ustwitter}}" ></div>

								@if ($errors->has('ustwitter'))
									<span class="help-block">
										<strong>{{ $errors->first('ustwitter') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('usfacebook') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Facebook</label>
							<div class="col-md-6">
								<div class="maskhos-pro-div"><input type="text" class="form-control maskhos-z-input" name="usfacebook" value="{{ $data['user']->usfacebook}}" ></div>

								@if ($errors->has('usfacebook'))
									<span class="help-block">
										<strong>{{ $errors->first('usfacebook') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('usinstagram') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Instagram</label>
							<div class="col-md-6">
								<div class="maskhos-pro-div"><input type="text" class="form-control maskhos-z-input" name="usinstagram" value="{{ $data['user']->usinstagram}}" ></div>

								@if ($errors->has('usinstagram'))
									<span class="help-block">
										<strong>{{ $errors->first('usinstagram') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('ustumlr') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Tumblr</label>
							<div class="col-md-6">
								<div class="maskhos-pro-div"><input type="text" class="form-control maskhos-z-input" name="ustumblr" value="{{ $data['user']->ustumblr}}" ></div>

								@if ($errors->has('ustumblr'))
									<span class="help-block">
										<strong>{{ $errors->first('ustumblr') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn maskhos-btn-primary">
									<i class="fa fa-btn fa-user"></i>Guardar
								</button>
							</div>
						</div>
					</fieldset>
				</form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
