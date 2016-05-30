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
	<!-- nombre personaje -->
		<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 maskhos-section-title maskhos-section-character">
			illo
		</div>
	</div>
</div>
		<div class="container-fluid maskhos-transparency">
			<div class="row" id="character_info">
				<!-- foto lateral izq -->
				<div id="character_portrait" class="col-md-3 col-xs-12 maskhos-portrait" style="background-image:url('../img/pj/ezequiel.png');">
					
				</div>
				
				<!-- desc personaje -->
				<div class="col-md-6 col-xs-12 maskhos-show">
					<h2>Nombre</h2><span class="maskhos-capitalize"> tuputamadre</span><br/>
					<h2>Clase</h2><span> el fucker</span><br/>
					<h2>Biografía</h1><span>nacido en los barrios del bronx</span><br/>
					<h2>Estilo de combate</h1><span>navajaso limpio illo</span><br/>
						<h2>Facción</h2><span>tus muertos entertaintment</span>
				</div>
				
				<!-- parrilla personajes -->
				<div class="col-md-3 col-xs-12 maskhos-show">
					<h2 class="text-center">Personajes</h2>
					<div class="row maskhos-parrilla">
						<a href="../personajestatic/1" class="col-md-4 col-xs-12 maskhos-parrilla-item text-center" style="background-image: url('../img/pj/azalea.png');">	</a>
						<a href="../personajestatic/1" class="col-md-4 col-xs-12 maskhos-parrilla-item text-center" style="background-image: url('../img/pj/azalea.png');">
						</a>
						<a href="../personajestatic/1" class="col-md-4 col-xs-12 maskhos-parrilla-item text-center" style="background-image: url('../img/pj/azalea.png');">
						</a>
						<a href="../personajestatic/1" class="col-md-4 col-xs-12 maskhos-parrilla-item text-center" style="background-image: url('../img/pj/azalea.png');">
						</a>
						<a href="../personajestatic/1" class="col-md-4 col-xs-12 maskhos-parrilla-item text-center" style="background-image: url('../img/pj/azalea.png');">
						</a>
						<a href="../personajestatic/1" class="col-md-4 col-xs-12 maskhos-parrilla-item-spoiler text-center">
						</a>
						<a href="../personajestatic/1" class="col-md-4 col-xs-12 maskhos-parrilla-item text-center" style="background-image: url('../img/pj/azalea.png');">	</a>
						<a href="../personajestatic/1" class="col-md-4 col-xs-12 maskhos-parrilla-item text-center" style="background-image: url('../img/pj/azalea.png');">
						</a>
						<a href="../personajestatic/1" class="col-md-4 col-xs-12 maskhos-parrilla-item-spoiler text-center">
						</a>
						<a href="../personajestatic/1" class="col-md-4 col-xs-12 maskhos-parrilla-item text-center" style="background-image: url('../img/pj/azalea.png');">
						</a>
						<a href="../personajestatic/1" class="col-md-4 col-xs-12 maskhos-parrilla-item text-center" style="background-image: url('../img/pj/azalea.png');">
						</a>
						<a href="../personajestatic/1" class="col-md-4 col-xs-12 maskhos-parrilla-item text-center" style="background-image: url('../img/pj/azalea.png');">
						</a>
					</div>
				</div>
			</div>
		</div>
@endsection