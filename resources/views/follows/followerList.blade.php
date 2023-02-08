@extends('layouts.login')

@section('content')

@foreach($user_icons as $icon)
<a href="/profile/{{$icon->id}}"><img src="storage/{{$icon->images}}"></a>
@endforeach

@foreach($posts as $post)
<div>
  <img src="storage/{{$icon->images}}">
  {{$post->username}}
  {{$post->posts}}
  {{$post->created_at}}
</div>
@endforeach
@endsection
