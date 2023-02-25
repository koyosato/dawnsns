<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;

class PostsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $follow_count = DB::table('follows')
            ->where('follower', auth::id())
            ->count();
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('users.username', 'users.images', 'posts.id', 'posts.posts', 'posts.created_at as created_at')
            ->where('posts.user_id', Auth::id())
            ->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $newPost = $request->newPost;

        DB::table('posts')
            ->where('id', $id)
            ->update([
                'posts' => $newPost,
            ]);
        return back();

        return view('posts.edit', ['posts' => $posts]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        DB::table('posts')
            ->where('id', $id)
            ->delete();
        return back();
    }

    public function store(Request $request)
    {
        $posts = new Post;
        $posts->user_id = Auth::id();
        $posts->posts = $request->posts;
        $posts->save();
        return back();
    }
}
