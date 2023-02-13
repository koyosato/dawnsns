@extends('layouts.login')

@section('content')
<div>
  <img src="{{ asset('images/' . $user->images) }}">
  <form action="profile-update" method="POST">
    <label>Username</label>
    @csrf
    @method('PATCH')
    <input type="text" name="username" value="{{ $user->username }}">
    <label>Mail</label>
    @csrf
    @method('PATCH')
    <input type="mail" name="mail" value="{{ $user->mail }}">
    <label>Password</label>
    @csrf
    @method('PATCH')
    <input type="text" name="password" value="{{ $user->password }}">
    <label>Bio</label>
    @csrf
    @method('PATCH')
    <input type="text" name="bio" value="{{ $user->bio }}">
    <input type="submit" value="更新">
  </form>
</div>

@endsection
