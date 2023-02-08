@extends('layouts.login')

@section('content')

<div>
  <img src="{{ asset('images/' . $user->images) }}">
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

@endsection
