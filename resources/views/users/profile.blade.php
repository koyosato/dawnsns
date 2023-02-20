@extends('layouts.login')

@section('content')

<div>
  <img src="{{ asset('storage/images/' . $user->images) }} " class="profile_image">
  {{$user->username}}
  {{$user->bio}}
</div>
@if($follow->contains($user->id))
<form action="/unfollow" method="post">
  @csrf
  <input type="hidden" name="id" value="{{$user->id}}">
  <input type="submit" value="フォローを外す">
</form>
@else
<form action="/follow" method="post">
  @csrf
  <input type="hidden" name="id" value="{{$user->id}}">
  <input type="submit" value="フォローする">
</form>
@endif

@foreach($posts as $post)
<div>
  {{$post->posts}}
  {{$post->created_at}}
</div>
@endforeach

@endsection
