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
					<form enctype="multipart/form-data" class="form-horizontal maskhos-form" role="form" method="POST" action="{{ url('/backend/editpost') }}">
						<legend class="text-center"><span class="number">1</span>Editar Post</legend>
						<fieldset>
							{!! csrf_field() !!}

							<div class="form-group{{ $errors->has('postitle') ? ' has-error' : '' }}">
								<label class="col-md-4 control-label">Titulo del post</label>

								<div class="col-md-6">
									<div class="maskhos-pro-div"><input type="text" class="form-control maskhos-z-input" name="postitle" value="{{$data['post']->postitle}}"></div>

									@if ($errors->has('postitle'))
									<span class="help-block">
										<strong>{{ $errors->first('postitle') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
								<label class="col-md-4 control-label">Categoria</label>

								<div class="col-md-6">
									<div class="maskhos-pro-div">
										<select class="form-control maskhos-z-input-select" name="category">
											@foreach ($data['categorys'] as $category)
											@if($data['post']->category_id == $category->id)
											<option selected value="{{ $category->id }}">{{ $category->catname }}</option>
											@else
											<option  value="{{ $category->id }}">{{ $category->catname }}</option>
											@endif
											@endforeach
										</select></div>

										@if ($errors->has('category'))
										<span class="help-block">
											<strong>{{ $errors->first('category') }}</strong>
										</span>
										@endif
									</div>
								</div>

								<div class="form-group{{ $errors->has('posshortdesc') ? ' has-error' : '' }}">
									<label class="col-md-4 control-label">Descripcion corta</label>

									<div class="col-md-6">
										<div class="maskhos-pro-div"><input type="text" class="form-control maskhos-z-input" name="posshortdesc" value="{{ $data['post']->posshortdesc }}"></input></div>

										@if ($errors->has('posshortdesc'))
										<span class="help-block">
											<strong>{{ $errors->first('posshortdesc') }}</strong>
										</span>
										@endif
									</div>
								</div>

								<div class="form-group{{ $errors->has('poscontent') ? ' has-error' : '' }}">
									<label class="col-md-4 control-label">Contenido del post</label>

									<div class="col-md-6">
										<div class="maskhos-pro-div"><textarea class="form-control maskhos-z-input" name="poscontent" >{{ $data['post']->poscontent }}</textarea></div>

										@if ($errors->has('poscontent'))
										<span class="help-block">
											<strong>{{ $errors->first('poscontent') }}</strong>
										</span>
										@endif
									</div>
								</div>

								<div class="form-group{{ $errors->has('posphoto') ? ' has-error' : '' }}">
									<label class="col-md-4 control-label">Foto portada</label>

									<div class="col-md-6">
										<div class="maskhos-pro-div"><input type="file" class="form-control maskhos-z-input" name="posphoto" value="{{ $data['post']->posphoto }}"></input></div>

										@if ($errors->has('posphoto'))
										<span class="help-block">
											<strong>{{ $errors->first('posphoto') }}</strong>
										</span>
										@endif
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn maskhos-btn-primary">
											<i class="fa fa-btn fa-pencil"></i>Editar
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
