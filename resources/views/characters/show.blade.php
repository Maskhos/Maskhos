@extends('layouts.app')

@section('content')
	@foreach ($data['character'] as $character)
	<!-- nombre personaje -->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="col-md-12 maskhos-section-title maskhos-section-character">
						{{$character->charname}}
					</h1>
				</div>
			</div>
		</div>
		<div class="container-fluid maskhos-transparency">
			<div class="row" id="character_info">
				<!-- foto lateral izq -->
				<div id="character_portrait" class="col-md-3 col-xs-12 maskhos-portrait" style="background-image:url('{{$character->charportrait}}');">
					
				</div>
				
				<!-- desc personaje -->
				<div class="col-md-6 col-xs-12 maskhos-top-buffer">
					
				</div>
				
				<!-- parrilla personajes -->
				<div class="col-md-3 col-xs-12">
					
				</div>
			</div>
		</div>
	@endforeach
@endsection