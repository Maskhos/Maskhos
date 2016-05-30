@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<img class="img-responsive maskhos-center-image maskhos-main-image" src="../public/img/titulo_center.png" />
			</div>
		</div>
	</div>
	<div class="container-fluid maskhos-paint">
		<div class="row maskhos-top-buffer">
			<div class="col-md-8 col-md-offset-2 maskhos-narrate">
				@foreach ($data['history'] as $history)
					{{$history->hisdescription}}
				@endforeach
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 maskhos-section-title maskhos-section-section">
				Facciones
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row maskhos-show">
			@foreach ($data['factions'] as $faction)
				<div class="col-md-12 maskhos-alternar">
					@if ($faction->id % 2 != 0)
						<img class="maskhos-faction-logo" src="data:image/png;base64,{{$faction->facphoto}}" />
						<span class="maskhos-titular">{{$faction->facname}}</span>
					@else
						<span class="maskhos-titular">{{$faction->facname}}</span>
						<img class="maskhos-faction-logo" src="data:image/png;base64,{{$faction->facphoto}}" />
					@endif
					<hr/>
					<div class="maskhos-faction">
						{{$faction->facdescription}}
					</div>
				</div>
			@endforeach
		</div>
	</div>
	
@endsection