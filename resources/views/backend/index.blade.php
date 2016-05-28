@extends('layouts.app')

@section('content')
<div class="background">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="col-md-12 maskhos-section-title maskhos-section-section">
          BACKEND
        </h1>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <a href="{{url('backend/createpost')}}" class="btn btn-default "> Create Post</a>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <table class="table" style="background-color:white;">
          <thead>
            <tr>
              <td>
                Numero de post
              </td>
              <td>
                Titulo Post
              </td>
              <td>
                Creador de Post
              </td>
              <td>

              </td>
            </tr>
          </thead>
          <tbody>
            @foreach($data['post'] as $post)
            <tr>
              <td>
                {{$post->id}}
              </td>
              <td>
                {{$post->postitle}}
              </td>
              @foreach($data['user'] as $user  )
              @if($post->user_id == $user->id)

              <td>
                {{$user->usname}}
              </td>
              <td>
                @if($user->id == Auth::id() || Auth::user()->ussuperadmin)

                <a href="{{url('backend/deletepost/'. $post->id)}}" class="btn btn-danger fa fa-trash-o col-xs-2" />
                  <a href="{{url('backend/editPost/'. $post->id)}}" class="btn btn-primary fa fa-pencil col-xs-2" />
                    @else
                    <a  class="btn btn-danger fa fa-lock col-xs-2" />
                    @endif

                  </td>

                  @endif
                  @endforeach

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    @endsection
