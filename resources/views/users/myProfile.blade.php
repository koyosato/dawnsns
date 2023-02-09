@extends('layouts.login')

@section('content')
<div>
  <img src="{{ asset('images/' . $user->images) }}">
  <form action="post">
    <label>Username</label>
    @csrf
    @method('PATCH')
    <input type="text" name="name" value="{{ old('username', $user->username) }}">
    <label>Mail</label>
    @csrf
    @method('PATCH')
    <input type="mail" name="mail" value="{{ old('mail', $user->mail) }}">
    <label>Password</label>
    @csrf
    @method('PATCH')
    <input type="text" name="password" value="{{ old('password', $user->password) }}">
    <label>Bio</label>
    @csrf
    @method('PATCH')
    <input type="text" name="bio" value="{{ old('bio', $user->bio) }}">
    <button><a href="/profile-update" method="patch">送信</a></button>
  </form>
</div>

@endsection
