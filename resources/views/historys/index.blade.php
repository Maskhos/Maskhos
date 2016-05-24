@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row" id="go">
			<div class="col-md-12">
				<h1 class="maskhos-section-title maskhos-section-section">Historia</h1>
			</div>
		</div>
		<div class="row maskhos-top-buffer">
			<div class="col-md-10 col-md-offset-1 jumbotron text-center img-rounded">
				@foreach ($data['history'] as $history)
					<h4>
						{{ $history->histitle }}
					</h4>
				@endforeach
			</div>
		</div>
		<div class="row">
		@foreach ($data['factions'] as $faction)
			
				<div class="col-md-8 col-md-offset-2 jumbotron maskhos-alternar">
					<h2>{{ $faction->facname }}</h2>
					{{ $faction->facshortdescription }}
				</div>
			
		@endforeach
		</div>
	</div>
	
@endsection