@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row" id="go">
			<div class="col-md-12">
				<h1 class="maskhos-section-title maskhos-section-section">Mecánicas de juego</h1>
			</div>
		</div>
		<div class="row maskhos-transparency">
			<div class="col-md-12">
				<ul class="nav nav-tabs maskhos-top-buffer maskhos-pill">
					@foreach ($data['mechanics'] as $mechanic)
						@if ($mechanic->mecactive)					
							<li class="active"><a href="#{{$mechanic->mectitle}}" data-toggle="tab" aria-expanded="false">{{$mechanic->mectitle}}</a></li>
						@else
							<li class=""><a href="#{{$mechanic->mectitle}}" data-toggle="tab" aria-expanded="false">{{$mechanic->mectitle}}</a></li>
						@endif
					@endforeach
				</ul>
				
					<div class="row">
						<div id="mechanics" class="tab-content maskhos-show maskhos-top-buffer">
							@foreach ($data['mechanics'] as $mechanic)
								@if ($mechanic->mecactive)		
									<div class="tab-pane fade active in row" id="{{$mechanic->mectitle}}">
								@else
									<div class="tab-pane fade row" id="{{$mechanic->mectitle}}">
								@endif
										<div class="col-md-6">
											<h2>{{$mechanic->mectitle}}</h2>
											<p>
												{{$mechanic->mecdescription}}
											</p>
										</div>
										<div class="col-md-6 maskhos-horizontal-padding">
											<img class="img-responsive" src="data:image/png;base64,{{$mechanic->mecpicture}}" />
										</div>
										<div class="col-md-12 text-center maskhos-horizontal-padding">
											<h2>Vídeo explicativo</h2>
											Para explicarlo mejor, podéis echar un vistazo a este vídeo:
											<div class="embed-responsive embed-responsive-16by9 maskhos-top-buffer">
												<iframe width="560" height="315" src="{{$mechanic->mecvideo}}" frameborder="0" allowfullscreen></iframe>
											</div>
										</div>
									</div>
							@endforeach
						</div>
					</div>
				
			</div>
		</div>
	</div>
	
@endsection