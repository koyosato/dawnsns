@extends('layouts.login')

@section('content')

<div>
  <img src="{{ asset('storage/images/' . $user->images) }}" class="profile_image">
  <form action="profile-update" method="POST" enctype="multipart/form-data">

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

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
    <label>Image</label>
    <input type="file" name="image"><br>


    <input type="submit" value="更新">
  </form>
</div>

@endsection
