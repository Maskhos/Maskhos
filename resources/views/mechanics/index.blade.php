@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row" id="go">
			<div class="col-md-12">
				<h1 class="maskhos-section-title maskhos-section-section">Mecánicas de juego</h1>
			</div>
		</div>
		
		@foreach ($data['mechanics'] as $mechanic)
			<div class="row">
				<div class="col-md-8 col-md-offset-2 jumbotron img-rounded maskhos-alternar">
					<h2>{{ $mechanic->mectitle }}</h2>
					{{ $mechanic->mecdescription }}
				</div>
			</div>
		@endforeach
	</div>
	
@endsection