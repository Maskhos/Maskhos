@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default maskhos-form">
				<form class="form-horizontal maskhos-form" role="form" method="POST" action="{{ url('/login') }}">
					<legend class="text-center"><span class="number"></span>Login</legend>
					<fieldset>
					{!! csrf_field() !!}

					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label class="col-md-4 control-label">E-Mail Address</label>

						<div class="col-md-6">
						   <div class="maskhos-pro-div"><input type="email" class="form-control maskhos-z-input" name="email" value="{{ old('email') }}"></div>

							@if ($errors->has('email'))
								<span class="help-block maskhos-z-input">
									{{ $errors->first('email') }}
								</span>
							@endif
						</div>
					</div>
					
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label class="col-md-4 control-label">Password</label>

						<div class="col-md-6">
							<div class="maskhos-pro-div"><input type="password" class="form-control maskhos-z-input" name="password"></div>

							@if ($errors->has('password'))
								<span class="help-block maskhos-z-input">
									{{ $errors->first('password') }}
								</span>
							@endif
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember"> Remember Me
								</label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-8 col-md-offset-4">
							<button type="submit" class="btn maskhos-btn-primary">
								<i class="fa fa-btn fa-sign-in"></i>Login
							</button>
							<a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
						</div>
					</div>
					</fieldset>
				</form>
            </div>
        </div>
    </div>
</div>
@endsection
