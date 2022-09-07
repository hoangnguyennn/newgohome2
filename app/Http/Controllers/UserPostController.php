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
            ->orderBy('created_at', 'desc');

        $id = $request->query('id');
        $title = $request->query('title');
        $phone = $request->query('phone');

        if ($id) {
            $q = strtoupper($id);
            if (count(explode("-", $q)) > 1) {
                $typeCode = explode("-", $q)[0];
                $id = explode("-", $q)[1];

                $cat = Category::where('shorthand', $typeCode)->first();

                if ($cat == null) {
                    $posts = $posts->where('id', -1);
                } else {
                    $posts = $posts->where('id_by_category', $id)->where('category_id', $cat->id);
                }
            }
        }

        if ($title) {
            $qSeparate = explode(' ', $title);
            $qSeparate = implode(' +', $qSeparate);
            $posts = $posts->where(function ($query) use ($title, $qSeparate) {
                $query->where('name', 'LIKE', '%' . $title . '%')
                    ->orWhereRaw("MATCH (name) AGAINST (? IN BOOLEAN MODE)", $qSeparate);
            });
        }

        if ($phone) {
            $posts = $posts->where('owner_phone', 'LIKE', '%' . $phone . '%')
                ->orWhere(function ($query) use ($phone) {
                    $query->where('owner_phone', $phone);
                });
        }

        $posts = $posts->paginate(20);

        if ($id) {
            $posts->appends(['id' => $id]);
        }

        if ($title) {
            $posts->appends(['title' => $title]);
        }

        if ($phone) {
            $posts->appends(['phone' => $phone]);
        }

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

    function moveAllPost(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $posts = Post::where('user_id', $from)->update(['user_id' => $to]);

        $userFrom = User::find($from);
        $userTo = User::find($to);

        return redirect()->route('users.posts.index', $from)->with('success', 'Đã chuyển ' . $posts . ' bài đăng từ ' . $userFrom->fullname . ' sang cho ' . $userTo->fullname);
    }
}
