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

        return view('users.profile', ['user' => $user, 'follow' => $follow_ids]);
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

        return view('users.search', ['users' => $users, 'follow' => $follow_ids]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->username = $request->username;
        $user->umail = $request->mail;
        $user->password = $request->password;
        $user->bio = $request->bio;

        $request->validate([
            'username' => ['required', 'string', 'min:4', 'max:12'],
            'mail' => ['required', 'string', 'email', 'min:4', 'max:12'],
            'password' => ['required', 'string', 'min:4', 'max:12'],
            'bio' => ['string', 'max:200']
        ]);

        DB::table('users')
            ->where('id', Auth::id())
            ->update(
                [
                    'username' => $user->username,
                    'mail' => $user->umail,
                    'password' => $user->password,
                    'bio' => $user->bio
                ]
            );

        return back();
    }
}
