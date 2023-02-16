@extends('layouts.login')

@section('content')
<div>
  <img src="{{ asset('images/' . $user->images) }}">
  <form action="profile-update" method="POST">
    @csrf
    @method('PATCH')
    <label>Username</label>
    <input type="text" name="username" value="{{ $user->username }}"><br>
    <label>Mail</label>
    <input type="mail" name="mail" value="{{ $user->mail }}"><br>
    <label>Password</label>
    <input type="text" name="password" value="{{ $user->password }}" readonly><br>
    <label>new Password</label>
    <input type="text" name="new_password" value="{{$user->new_password}}"><br>
    <label>Bio</label>
    <input type="text" name="bio" value="{{ $user->bio }}"><br>

    <input type="submit" value="更新">
  </form>
</div>

@endsection
