<?php

namespace App\Http\Controllers;

use App\Helpers\GenerateImageHelper;
use App\Models\Category;
use App\Models\District;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Exception;

class PostController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // mark noti as read
        if ($request->query('noti')) {
            $noti = DatabaseNotification::find($request->query('noti'));

            if ($noti) {
                $noti->markAsRead();
            }
        }

        $user = Auth::user();
        if ($user->isAdmin()) {
            $posts = Post::where('is_hide', 0);
        } else {
            $posts = Post::where('user_id', $user->id)->where('is_hide', 0);
        }

        $id = $request->query('id');
        $title = $request->query('title');
        $phone = $request->query('phone');

        if ($id) {
            $q = strtoupper($id);
            if (count(explode("-", $q)) > 1) {
                $typeCode = explode("-", $q)[0];
                $id = explode("-", $q)[1];

                $cat = Category::where('shorthand', $typeCode)->first();
                $posts = $posts->where('id_by_category', $id)->where('category_id', $cat->id);
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

        $posts = $posts->orderBy('verify_status', 'desc')->orderBy('created_at', 'desc')->paginate(20);

        if ($id) {
            $posts->appends(['id' => $id]);
        }

        if ($title) {
            $posts->appends(['title' => $title]);
        }

        if ($phone) {
            $posts->appends(['phone' => $phone]);
        }

        $postsCount = Post::where('is_hide', 0)
            ->where('verify_status', '!=', 2)
            ->select('category_id', DB::raw('count(*) as total'))
            ->groupBy('category_id')
            ->orderBy('total', 'desc')
            ->get();

        return view('pages.manager.posts.list', compact('posts', 'postsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_hide', false)->get();
        $districts = District::where('is_hide', false)->get();
        return view('pages.manager.posts.create', compact('categories', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $category = Category::find($request->input('category'));

        $post = new Post;
        $post->id_by_category = $category->count + 1;
        $post->name = $request->input('title');
        $post->slug = Str::slug($request->input('title')) . '-' . uniqid();
        $post->category_id = $request->input('category');
        $post->ward_id = $request->input('ward');
        $post->price = (float) $request->input('price');
        $post->discount = (float) $request->input('discount');
        $post->commission = (float) $request->input('commission');
        $post->acreage = (int) $request->input('acreage');
        $post->bedroom = (int) $request->input('bedroom');
        $post->toilet = (int) $request->input('toilet');
        $post->floor = (int) $request->input('floor');
        $post->description = $request->input('description');
        $post->owner_name = $request->input('owner-name');
        $post->owner_phone = $request->input('owner-phone');
        $post->owner_address = $request->input('owner-address');
        $post->is_cheap = (bool) $request->input('is-cheap');
        $post->is_featured = (bool) $request->input('is-featured');
        $post->is_hide = $request->input('status');
        $post->verify_status = $user->isAdmin() ? 0 : 1;
        $post->user_id = $user->id;
        $post->save();

        $category->count = $category->count + 1;
        $category->save();

        if ($request->has('image')) {
            $imageIds = $request->image;
            foreach ($imageIds as $imageId) {
                $postImage = PostImage::findOrFail($imageId);
                $postImage->post_id = $post->id;
                $postImage->save();

                GenerateImageHelper::generate($postImage->id, $post);
            }
        }

        // gửi mail đến admin
        // if (!$user->isAdmin()) {
        //     $admins = User::where('role', 'admin')->get();

        //     $data = [
        //         'fullname' => $user->fullname,
        //         'phone' => null,
        //         'type' => 3,
        //         'action' => 'tạo bài đăng',
        //         'title' => $post->name,
        //         'link' => url('/manager/posts'),
        //         'created_at' => Carbon::now(),
        //     ];

        //     foreach ($admins as $admin) {
        //         $admin->notify(new PostNotification($data));
        //     }
        // }

        return redirect()->route('posts.index')->with('success', 'Tạo bài đăng mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.manager.posts.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::where('is_hide', false)->get();
        $districts = District::where('is_hide', false)->get();
        $wards = Ward::where('is_hide', 'false')->where('district_id', $post->ward->district_id)->get();
        return view('pages.manager.posts.edit', compact('categories', 'districts', 'wards', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $user = Auth::user();
        $category = Category::find($request->input('category'));

        if ($post->name !== $request->input('title')) {
            $newSlug = Str::slug($request->input('title')) . '-' . uniqid();
        } else {
            $newSlug = $post->slug;
        }

        if ($request->input('category') != $post->category_id) {
            $post->id_by_category = $category->count + 1;
            $post->category_id = $request->input('category');
            $category->count = $category->count + 1;
            $category->save();
        }

        // nếu bài viết đang ẩn và trạng thái mới là hiện thì verify_status = 1 (chưa duyệt)
        if ($post->is_hide == 1 && $request->input('status') == 0) {
            $post->verify_status = 1;
            $post->deny_reason = '';
        }

        $post->name = $request->input('title');
        $post->slug = $newSlug;
        $post->ward_id = $request->input('ward');
        $post->price = (float) $request->input('price');
        $post->discount = (float) $request->input('discount');
        $post->commission = (float) $request->input('commission');
        $post->acreage = (int) $request->input('acreage');
        $post->bedroom = (int) $request->input('bedroom');
        $post->toilet = (int) $request->input('toilet');
        $post->floor = (int) $request->input('floor');
        $post->description = $request->input('description');
        $post->owner_name = $request->input('owner-name');
        $post->owner_phone = $request->input('owner-phone');
        $post->owner_address = $request->input('owner-address');
        $post->is_cheap = (bool) $request->input('is-cheap');
        $post->is_featured = (bool) $request->input('is-featured');
        $post->is_hide = $request->input('status');
        $post->user_update_id = $user->id;
        $post->save();

        if ($request->has('image')) {
            $imageIds = $request->image;
            foreach ($imageIds as $imageId) {
                $postImage = PostImage::findOrFail($imageId);
                $postImage->post_id = $post->id;
                $postImage->save();

                GenerateImageHelper::generate($postImage->id, $post);
            }
        }

        if ($request->has('imageRemove')) {
            $imageIds = $request->imageRemove;
            foreach ($imageIds as $imageId) {
                $postImage = PostImage::findOrFail($imageId);
                $postImage->post_id = null;
                $postImage->save();
            }
        }

        // gửi mail đến admin
        // if (!$user->isAdmin()) {
        //     $admins = User::where('role', 'admin')->get();

        //     $data = [
        //         'fullname' => $user->fullname,
        //         'phone' => null,
        //         'type' => 4,
        //         'action' => 'cập nhật bài đăng',
        //         'title' => $post->name,
        //         'link' => url('/manager/posts'),
        //         'created_at' => Carbon::now(),
        //     ];

        //     foreach ($admins as $admin) {
        //         $admin->notify(new PostNotification($data));
        //     }
        // }

        return redirect()->route('posts.index')->with('success', 'Chỉnh sửa bài đăng mới thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $currentUser = Auth::user();

        if ($currentUser && ($currentUser->id == $post->user_id || $currentUser->isAdmin())) {
            Post::findOrFail($post->id)->delete();
            return redirect()->route('posts.index')->with('success', 'Xóa bài đăng thành công');
        }

        return back()->with('danger', 'Bạn không có quyền xóa bài đăng này');
    }

    public function verify(Post $post)
    {
        try {
            $user = Auth::user();

            $post->verify_status = 0;
            $post->deny_reason = '';
            $post->save();

            // gửi mail cho admin sau khi duyệt
            // gửi mail cho user nếu post của user đó

            // $admins = User::where('role', 'admin')->where('id', '!=', $user->id)->get();

            // $data = [
            //     'fullname' => $user->fullname,
            //     'phone' => null,
            //     'type' => 'duyệt bài',
            //     'action' => 'duyệt bài',
            //     'title' => $post->name,
            //     'link' => url('/manager/posts'),
            //     'created_at' => Carbon::now(),
            // ];

            // foreach ($admins as $admin) {
            //     $admin->notify(new PostNotification($data));
            // }

            // $post->user->notify(new PostNotification($data));

            return redirect()->route('post', $post->slug)->with('success', 'Duyệt bài đăng thành công');
        } catch (Exception $e) {
            return redirect()->route('post', $post->slug)->with('danger', 'Duyệt bài đăng thất bại, vui lòng thử lại sau');
        }
    }

    public function deny(Request $request, Post $post)
    {
        try {
            $user = Auth::user();

            $post->verify_status = 2;
            $post->deny_reason = $request->input('deny-reason');
            $post->save();

            // gửi mail cho admin sau khi duyệt
            // gửi mail cho user nếu post của user đó

            // $admins = User::where('role', 'admin')->where('id', '!=', $user->id)->get();

            // $data = [
            //     'fullname' => $user->fullname,
            //     'phone' => null,
            //     'type' => 'từ chối duyệt bài',
            //     'action' => 'từ chối duyệt bài',
            //     'title' => $post->name,
            //     'link' => url('/manager/posts'),
            //     'created_at' => Carbon::now(),
            // ];

            // foreach ($admins as $admin) {
            //     $admin->notify(new PostNotification($data));
            // }

            // $post->user->notify(new PostNotification($data));

            return redirect()->route('post', $post->slug)->with('success', 'Từ chối bài đăng thành công');
        } catch (Exception $e) {
            return redirect()->route('post', $post->slug)->with('danger', 'Từ chối bài đăng thất bại, vui lòng thử lại sau');
        }
    }

    public function rented(Request $request)
    {
        // mark noti as read
        if ($request->query('noti')) {
            $noti = DatabaseNotification::find($request->query('noti'));

            if ($noti) {
                $noti->markAsRead();
            }
        }

        $user = Auth::user();
        if ($user->isAdmin()) {
            $posts = Post::where('is_hide', true);
        } else {
            $posts = Post::where('user_id', $user->id)->where('is_hide', true);
        }

        $id = $request->query('id');
        $title = $request->query('title');
        $phone = $request->query('phone');

        if ($id) {
            $q = strtoupper($id);
            if (count(explode("-", $q)) > 1) {
                $typeCode = explode("-", $q)[0];
                $id = explode("-", $q)[1];

                $type = Category::where('shorthand', $typeCode)->first();

                if ($type) {
                    $posts = $posts->where('id_by_category', $id)->where('category_id', $type->id);
                } else {
                    $posts = $posts->where('id_by_category', null);
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

            // $posts = $posts->where('name', 'LIKE', '%' . $title . '%')
            //     ->orWhereRaw("MATCH (name) AGAINST (? IN BOOLEAN MODE)", $qSeparate);
        }

        if ($phone) {
            $posts = $posts->where('owner_phone', 'LIKE', '%' . $phone . '%');
        }

        $posts = $posts->orderBy('verify_status', 'desc')->orderBy('created_at', 'desc')->paginate(20);

        if ($id) {
            $posts->appends(['id' => $id]);
        }

        if ($title) {
            $posts->appends(['title' => $title]);
        }

        if ($phone) {
            $posts->appends(['phone' => $phone]);
        }

        return view('pages.manager.posts.rented-list', compact('posts'));
    }

    public function hide(Post $post)
    {
        $post->is_hide = true;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Đã ẩn bài đăng');
    }

    public function movePosts(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        if (!$from || !$to) {
            return redirect()->route('users.index')->with('warning', 'Không tìm thấy người dùng');
        }

        $userFrom = User::findOrFail($from);
        $userTo = User::findOrFail($to);

        Post::where('user_id', $from)->update(['user_id' => $to]);
        return redirect()->route('users.index')->with('success', 'Đã di chuyển tất cả bài đăng của ' . $userFrom->fullname . ' sang cho ' . $userTo->fullname);
    }
}
