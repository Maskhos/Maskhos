@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row maskhos-row">
    <div class="col-md-12 maskhos-header">
    </div>
  </div>
  <div class="row maskhos-paint-light maskhos-row">
    <div class="col-md-8 col-md-offset-2 maskhos-narrate maskhos-top-buffer">
      @foreach ($data['story'] as $story)
      {{$story->hisshortDescription}}
      @endforeach
    </div>
  </div>
  <div class="row maskhos-row maskhos-paint-dark maskhos-top-buffer">
    <div class="col-md-8 col-md-offset-2">
      <h2 class="maskhos-titular">Noticias recientes</h2>
      @foreach ($data['news'] as $new)
      <div class="row maskhos-show">
        <div class="col-md-12 maskhos-quick-news">
          <div class="row">
            <div class="col-md-6 col-xs-12">
              <img src="data:image/png;base64,{{$new->posphoto}}" class="maskhos-faction-logo" /> {{$new->users->usname}} > <a href="{{ url('/blog/category/'.$new->category_id) }}">{{$new->categorys->catname}}</a>
            </div>
            <div class="col-md-3 col-md-offset-3 col-xs-12 maskhos-quick-date">
              En {{$new->posdate}}
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 maskhos-quick-news-short">
              <a href="{{url('/blog/'.$new->id)}}">{{$new->postitle}}</a>
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
