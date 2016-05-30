@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 maskhos-section-title maskhos-section-character">
			Entradas del blog
		</div>
	</div>

    <div class="row maskhos-row maskhos-paint-dark maskhos-top-buffer">
        <div class="col-md-8 col-md-offset-2">
				@foreach ($data['post'] as $new)
					<div class="row maskhos-show">
						<div class="col-md-12 maskhos-quick-news">
							<div class="row">
								<div class="col-md-6 col-xs-12">
									<img src="data:image/png;base64,{{$new->posphoto}}" class="maskhos-faction-logo" /> {{$new->users->usname}} <a href="{{ url('/blog/category/'.$new->categorys->id) }}">{{$new->categorys->catname}}</a>
								</div>
								<div class="col-md-3 col-md-offset-3 col-xs-12 maskhos-quick-date">
									En {{$new->posdate}}
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 maskhos-quick-news-short">
									<a href="{{url('/blog/'.$new->id)}}"><h2>{{$new->postitle}}</h2></a>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 maskhos-quick-news-short">
									{{$new->posshortdesc}}
								</div>
							</div>
						</div>
					</div>
				@endforeach
        </div>
    </div>
</div>
  @endsection
