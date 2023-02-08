@extends('layouts.login')

@section('content')
<div>
  <img src="{{ asset('images/' . $user->images) }}">
  <form action="post">
    <label>Username</label>
    <input type="text" name="name" value="{{ old('username', $user->username) }}">
    <label>Mail</label>
    <input type="mail" name="mail" value="{{ old('mail', $user->mail) }}">
    <label>Password</label>
    <input type="text" name="password" value="{{ old('password', $user->password) }}">
    <label>Bio</label>
    <input type="text" name="bio" value="{{ old('bio', $user->bio) }}">
  </form>
</div>

@endsection
