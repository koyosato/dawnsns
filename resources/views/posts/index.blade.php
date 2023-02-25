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
  <img src="{{ asset('storage/images/' . $post->images) }}" class="profile_image">
  {{ $post->username }}
  {{ $post->posts }}
  {{ $post->created_at }}

  <div class="modalopen" data-target="{{$post->id}}">
    <img class="" src="./images/edit.png">
  </div>


  <div class="modal-main js-modal" id="{{$post->id}}">
    <div class="modal-inner">
      <div class="inner-content">
        <form action="/edit" method="POST">
          @csrf
          <input type="hidden" value="{{$post->id}}" name="id">
          <textarea name="newPost">{{$post->posts}}</textarea>
          <input type="submit" value="編集">
        </form>
        <a class="send-button modalClose">Close</a>
      </div>
    </div>
  </div>

  <form action="/delete" method="POST">
    @csrf
    <input type="hidden" value="{{$post->id}}" name="id">
    <input type="submit" value="削除">
  </form>
</div>
@endforeach


@endsection
