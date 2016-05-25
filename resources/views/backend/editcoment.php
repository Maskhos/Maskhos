@extends('layouts.app')

@section('content')
<div class="background">
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="col-md-12 maskhos-section-title maskhos-section-section">
				Post
			</h1>
		</div>
	</div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default maskhos-form">
				<form enctype="multipart/form-data" class="form-horizontal maskhos-form" role="form" method="POST" action="{{ url('/post/editcoment/{{$coment->id}}') }}">
					<legend class="text-center"><span class="number">1</span>Edita tu comentario</legend>
					<fieldset>
						{!! csrf_field() !!}

						<div class="form-group{{ $errors->has('comcontent') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Contenido del post</label>

							<div class="col-md-6">
								<div class="maskhos-pro-div"><textarea class="form-control maskhos-z-input" name="comcontent" value="{{ old('comcontent') }}"></textarea></div>

								@if ($errors->has('comcontent'))
									<span class="help-block">
										<strong>{{ $errors->first('comcontent') }}</strong>
									</span>
								@endif
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
