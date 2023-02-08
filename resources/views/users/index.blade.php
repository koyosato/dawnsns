@extends('layouts.login')

@section('content')

@foreach($users as $user)
<a href="{{ route('users.show', ['id' => $user->id]) }}">
  {{ $user->username }}
</a>
@endforeach

@endsection
