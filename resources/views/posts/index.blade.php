@extends('layouts.login')

@section('content')
<div style="width:50%; margin: 0 auto; text-align:center;">
  <form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div>
      <textarea name="posts" placeholder="内容の入力"></textarea>
    </div>
    <button>送信</button>
  </form>
</div>

@foreach ($posts as $post)
<div>
  {{ $post->username }}
  {{ $post->posts }}
  {{ $post->created_at }}
</div>
@endforeach


@endsection
