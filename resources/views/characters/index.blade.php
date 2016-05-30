@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 maskhos-section-title maskhos-section-character">
			Personajes
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
	@foreach ($data['character'] as $character)
		@if ($character->spoiler)
			<div class="col-md-2 maskhos-character-spoiler" data-character="{{$character->charname}}">
				<span class="maskhos-name"><a data-toggle="modal" data-target="#spoiler">¡Spoiler!</a></span>
			</div>
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
					  <button type="button" class="btn btn-danger" data-dismiss="modal">¡No! Gracias</button>
					  <a class="btn btn-success" href="characters/{{$character->id}}">Acceder</a>
					</div>
				  </div>
				</div>
			  </div>
		@else
			<div class="col-md-2 maskhos-character" data-character="{{$character->charname}}" style="background-image: url('data:image/png;base64,{{$character->charportrait}}');">
				<span class="maskhos-name"><a href="characters/{{$character->id}}">{{$character->charname}}</a></span>
			</div>
		@endif
	@endforeach
	</div>
</div>
@endsection