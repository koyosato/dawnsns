@extends('layouts.login')

@section('content')

<form method="POST" action="/search">
  @csrf
  <input type="text" placeholder="ユーザー名を入力" name="keyword">
  <div>
    <button type="submit">検索</button>
  </div>
</form>


@foreach($users as $user)
<div>
  {{$user->username}}
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
@endforeach





@endsection
