@extends('layouts.app')

@section('content')
<div class="background">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 maskhos-section-title maskhos-section-section">
			Registro
		</div>
	</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default maskhos-form">
				<form class="form-horizontal maskhos-form" role="form" method="POST" action="{{ url('/register') }}">
					<legend class="text-center"><span class="number">1</span>Datos personales</legend>
					<fieldset>
						{!! csrf_field() !!}

						<div class="form-group{{ $errors->has('usname') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Nombre</label>

							<div class="col-md-6">
								<div class="maskhos-pro-div"><input type="text" class="form-control maskhos-z-input" name="usname" value="{{ old('usname') }}"></div>

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
								<div class="maskhos-pro-div"><input type="email" class="form-control maskhos-z-input" name="email" value="{{ old('email') }}"></div>

								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Contraseña</label>

							<div class="col-md-6">
								<div class="maskhos-pro-div"><input type="password" class="form-control maskhos-z-input" name="password"></div>

								@if ($errors->has('password'))
									<span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Confirma contraseña</label>

							<div class="col-md-6">
								<div class="maskhos-pro-div"><input type="password" class="form-control maskhos-z-input" name="password_confirmation"></div>

								@if ($errors->has('password_confirmation'))
									<span class="help-block">
										<strong>{{ $errors->first('password_confirmation') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('usbirthDate') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Fecha de nacimiento</label>

							<div class="col-md-6">
								<div class="maskhos-pro-div"><input type="date" class="form-control maskhos-z-input" name="usbirthDate" value="{{ old('usbirthDate') }}"></div>

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
										<option value="{{ $country->id }}">{{ $country->couname }}</option>
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
								<div class="maskhos-pro-div"><textarea class="form-control maskhos-z-input" name="usdesc" value="{{ old('usdesc') }}"></textarea></div>

								@if ($errors->has('usdesc'))
									<span class="help-block">
										<strong>{{ $errors->first('usdesc') }}</strong>
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
										<option value="{{ $faction->id }}">{{ $faction->facname }}</option>
									@endforeach
								</select></div>

								@if ($errors->has('faction'))
									<span class="help-block">
										<strong>{{ $errors->first('faction') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<br/><br/>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn maskhos-btn-primary">
									<i class="fa fa-btn fa-user"></i>Registrarse
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
