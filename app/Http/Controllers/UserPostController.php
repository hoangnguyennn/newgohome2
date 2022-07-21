<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPostController extends Controller
{
    function index(Request $request, User $user)
    {
        $posts = Post::where('user_id', $user->id)
            ->where('is_hide', 0)
            ->orderBy('verify_status', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $users = User::orderBy('fullname', 'asc')->get();

        return view('pages.manager.users.posts.index', compact('posts', 'user', 'users'));
    }

    function movePosts(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $postIds = $request->posts;

        if (!is_array($postIds)) {
            $postIds = [];
        }

        $posts = Post::whereIn('id', $postIds)->where('user_id', $from)->update([
            'user_id' => $to,
        ]);

        $userFrom = User::find($from);
        $userTo = User::find($to);

        return redirect()->route('users.posts.index', $from)->with('success', 'Đã chuyển ' . $posts . ' bài đăng từ ' . $userFrom->fullname . ' sang cho ' . $userTo->fullname);
    }
}
