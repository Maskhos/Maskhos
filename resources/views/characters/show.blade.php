@extends('layouts.app')

@section('scripts')
<script>
// La siguiente función consigue que la imagen que representa a un personaje cuando hemos seleccionado uno en la sección de personajes
// se mueva acorde al scroll
$(window).scroll(function(){
	var width = $(window).width();
	console.log(width);
	var maxHeight = document.getElementById('character_info').clientHeight;
	var imgHeight = document.getElementById('character_portrait').offsetHeight;
	if ((imgHeight + $(window).scrollTop())+30 < maxHeight && width >= 992) {
		// $("#character_portrait").stop().animate({"marginTop": ($(window).scrollTop()) + "px", "marginLeft":($(window).scrollLeft()) + "px"}, "slow" );
		$("#character_portrait").css({"margin-top": ($(window).scrollTop()) + "px", "margin-left":($(window).scrollLeft()) + "px"});
	} else {

	}
});
</script>
@endsection

@section('content')
@foreach ($data['character'] as $character)
<!-- nombre personaje -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 maskhos-section-title maskhos-section-character">
			{{$character->charname}}
		</div>
	</div>
</div>
<div class="container-fluid maskhos-transparency">
	<div class="row" id="character_info">
		<!-- foto lateral izq -->
		<div id="character_portrait" class="col-md-3 col-xs-12 maskhos-portrait" style="background-image:url('data:image/png;base64,{{$character->charportrait}}');">

		</div>

		<!-- desc personaje -->
		<div class="col-md-6 col-xs-12 maskhos-show">
			<h2>Nombre</h2><span class="maskhos-capitalize"> {{$character->charname}}</span><br/>
			<h2>Clase</h2><span> {{$character->charclass}}</span><br/>
			<h2>Biografía</h1><span>{{$character->charbio}}</span><br/>
				<h2>Estilo de combate</h1><span>{{$character->charstylecombat}}</span><br/>

					<h2>Facción</h2><span>{{$character->factions->facname}}</span>

				</div>

				<!-- parrilla personajes -->
				<div class="col-md-3 col-xs-12 maskhos-show">
					<h2 class="text-center">Personajes</h2>
					<div class="row maskhos-parrilla">
						@foreach ($data['all'] as $parrilla)
						@if ($parrilla->spoiler)
						<a href="../characters/{{$parrilla->id}}" data-toggle="modal" data-target="#spoiler" class="col-md-4 col-xs-12 maskhos-parrilla-item-spoiler text-center"></a>
						<!-- Modal -->
						<div class="modal fade" id="spoiler" role="dialog">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">¡Atención, spoiler!</h4>
									</div>
									<div class="modal-body">
										<p>Vas a acceder a un contenido que habla, explica o está relacionado con partes de la historia que quizás no querrías desvelarte.
											Acceder a este contenido implica que puedas descubrirte sorpresas.</p>
										</div>
										<div class="modal-footer">
											<a class="btn btn-danger" href="#" data-dismiss="modal">¡No! Gracias</a>
											<a class="btn btn-success" href="../characters/{{$parrilla->id}}">Acceder</a>
										</div>
									</div>
								</div>
							</div>
							@else
							<a href="../characters/{{$parrilla->id}}" class="col-md-4 col-xs-12 maskhos-parrilla-item text-center" style="background-image: url('data:image/png;base64,{{$parrilla->charportrait}}');">	</a>
							@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
			@endforeach
			@endsection
