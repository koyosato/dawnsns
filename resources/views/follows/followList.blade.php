@extends('layouts.login')

@section('content')

@foreach($user_icons as $icon)
<a href="/profile/{{$icon->id}}"><img src="storage/images/{{$icon->images}}" class="profile_image"></a>
@endforeach

@foreach($posts as $post)
<div>
  <img src="storage/images/{{$icon->images}}" class="profile_image">
  {{$post->username}}
  {{$post->posts}}
  {{$post->created_at}}
</div>
@endforeach

@endsection
