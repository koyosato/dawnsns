<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Follow;

class FollowsController extends Controller
{
    //
    public function followList()
    {
        $follow_ids = DB::table('follows')
            ->where('follower', Auth::id())
            ->pluck('follow');

        $user_icons = DB::table('users')
            ->whereIn('id', $follow_ids)
            ->select('id', 'images')
            ->get();

        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->whereIn('posts.user_id', $follow_ids)
            ->select('users.id', 'users.username', 'users.images', 'posts.posts', 'posts.created_at as created_at')
            ->get();

        return view('follows.followList', [
            'user_icons' => $user_icons,
            'posts' => $posts,
        ]);
    }

    public function followerList()
    {
        $follow_ids = DB::table('follows')
            ->where('follow', Auth::id())
            ->pluck('follower');

        $user_icons = DB::table('users')
            ->whereIn('id', $follow_ids)
            ->select('id', 'images')
            ->get();

        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->whereIn('posts.user_id', $follow_ids)
            ->select('users.id', 'users.username', 'users.images', 'posts.posts', 'posts.created_at as created_at')
            ->get();

        return view('follows.followerList', [
            'user_icons' => $user_icons,
            'posts' => $posts,
        ]);
    }

    public function create(Request $request)
    {
        $id = $request->input('id');
        DB::table('follows')
            ->insert([
                'follow' => $id,
                'follower' => Auth::id(),
                'created_at' => now(),
            ]);

        return back();
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        DB::table('follows')
            ->where([
                'follow' => $id,
                'follower' => Auth::id(),
            ])->delete();

        return back();
    }
}
