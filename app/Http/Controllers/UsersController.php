<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

class UsersController extends Controller
{

    public function profile($id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->select('username', 'bio', 'images', 'id')
            ->first();

        $follow_ids = DB::table('follows')
            ->where('follower', Auth::id())
            ->pluck('follow');

        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.user_id', $id)
            ->select('users.id', 'users.username', 'users.images', 'posts.posts', 'posts.created_at as created_at')
            ->get();

        return view('users.profile', ['user' => $user, 'follow' => $follow_ids, 'posts' => $posts]);
    }

    public function myProfile()
    {
        $user = Auth::user();

        return view('users.myProfile', ['user' => $user]);
    }

    public function search(Request $request)
    {

        if ($request->isMethod('post')) {
            $keyword = $request->input('keyword');
            $users = DB::table('users')
                ->where('username', 'like', '%' . $keyword . '%')
                ->get();
        } else {
            $users = DB::table('users')
                ->get();
        }

        $follow_ids = DB::table('follows')
            ->where('follower', Auth::id())
            ->pluck('follow');

        $user_icons = DB::table('users')
            ->where('id', $follow_ids)
            ->select('id', 'images')
            ->get();

        return view('users.search', ['users' => $users, 'follow' => $follow_ids, 'user_icons' => $user_icons]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'min:4', 'max:12'],
            'mail' => ['required', 'string', 'email', 'min:4', 'max:12'],
            'bio' => ['nullable', 'string', 'max:200'],
            'new_password' => ['nullable', 'string', 'min:4', 'max:50']
        ]);

        if (request('new_password')) {
            $newPassword = bcrypt($request->new_password);
        } else {
            $newPassword = DB::table('users')
                ->where('id', Auth::id())
                ->value('password');
        }


        if (request('image')) {
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images', $image_name);
        } else {
            $image_name = DB::table('users')
                ->where('id', Auth::id())
                ->value('images');
        }


        DB::table('users')
            ->where('id', Auth::id())
            ->update(
                [
                    'username' => $request->username,
                    'mail' => $request->mail,
                    'bio' => $request->bio,
                    'password' => $newPassword,
                    'images' => $image_name
                ]
            );

        return back();
    }
}
