<?php

namespace App\Http\Controllers;

use App\Exports\PostsExportUser;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Ward;
use Excel;
use Illuminate\Http\Request;

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
        $location = $request->query('location');
        $category = $request->query('category');
        $price = $request->query('price');

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

        if ($location) {
            $posts = $posts->where('ward_id', $location);
        }

        if ($category) {
            $posts = $posts->where('category_id', $category);
        }

        if ($price) {
            $texts = explode('-', $price);
            if (count($texts) === 2) {
                $posts = $posts->where('price', '>=', $texts[0]);
                $posts = $posts->where('price', '<=', $texts[1]);
            }
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

        if ($location) {
            $posts->appends(['location' => $location]);
        }

        if ($category) {
            $posts->appends(['category' => $category]);
        }

        if ($price) {
            $posts->appends(['price' => $price]);
        }

        $users = User::orderBy('fullname', 'asc')->get();
        $categories = Category::where('is_hide', 0)->orderBy('name', 'asc')->get();
        $wards = Ward::where('is_hide', 0)->get();

        return view('pages.manager.users.posts.index', compact('posts', 'user', 'users', 'categories', 'wards'));
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

    public function exportExcel(User $user)
    {
        return Excel::download(new PostsExportUser($user->id), 'ds-bai-dang-' . $user->fullname . '.xlsx');
    }
}
