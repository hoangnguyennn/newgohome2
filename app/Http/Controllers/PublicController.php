<?php

namespace App\Http\Controllers;

use App\Helpers\GenerateImageHelper;
use App\Models\Category;
use App\Models\Duration;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostRequestType;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function home(Request $request)
    {
        $seo = (object) [
            'title' => 'Trang chủ',
            'description' => 'Cho thuê nhà đất thành phố Nha Trang giá rẻ',
            'ogUrl' => route('home'),
            'ogTitle' => 'Cho thuê nhà đất thành phố Nha Trang giá rẻ',
            'ogImage' => $request->getSchemeAndHttpHost() . '/uploads/logo.jpg',
        ];

        $postRequestTypes = PostRequestType::all();
        $posts = Post::where('is_hide', 0)->where('verify_status', 0);
        $categories = Category::where('is_hide', 0)->orderBy('name', 'asc')->get();
        $wards = Ward::where('is_hide', 0)->get();
        $durations = Duration::all();
        $type = 'all';

        if ($request->query('type')) {
            if ($request->query('type') == 'cheap') {
                $posts = $posts->where('is_cheap', true);
                $type = 'cheap';
            } else if ($request->query('type') == 'featured') {
                $posts = $posts->where('is_featured', true);
                $type = 'featured';
            }
        }

        $posts = $posts->orderBy('updated_at', 'desc');
        $posts = $posts->paginate(12);
        $posts->appends(['type' => $type]);

        return view('pages.home', compact('seo', 'posts', 'categories', 'wards', 'postRequestTypes', 'type', 'durations'));
    }

    public function posts(Request $request)
    {
        $postRequestTypes = PostRequestType::all();
        $categories = Category::where('is_hide', 0)->orderBy('name', 'asc')->get();
        $wards = Ward::where('is_hide', 0)->get();
        $durations = Duration::all();
        $latestPosts = Post::orderBy('created_at', 'desc')
            ->where('is_hide', 0)
            ->where('verify_status', 0)
            ->paginate(3);

        $q = strtoupper($request->q);
        $location = $request->location;
        $category = $request->category;
        $duration = $request->duration;
        $price = $request->price;
        $acreage = (float) $request->acreage;
        $bedroom = (int) $request->bedroom;
        $toilet = (int) $request->toilet;
        $floor = (int) $request->floor;
        $type = 'all';



        $posts = Post::where('is_hide', 0)->where('verify_status', 0);

        if ($request->query('type')) {
            if ($request->query('type') == 'cheap') {
                $posts = $posts->where('is_cheap', true);
                $type = 'cheap';
            } else if ($request->query('type') == 'featured') {
                $posts = $posts->where('is_featured', true);
                $type = 'featured';
            }
        }
        // dd($posts->toSql(), $posts->getBindings());
        // echo $posts->count();

        if ($q) {
            if (count(explode("-", $q)) > 1) {
                $typeCode = explode("-", $q)[0];
                $id = explode("-", $q)[1];
                $currentCategory = Category::where('shorthand', $typeCode)->first();
                if ($currentCategory) {
                    $typeId = $currentCategory->id;
                } else {
                    $typeId = null;
                }
            } else {
                $id = null;
                $typeId = null;
            }

            $tmpQ = str_replace('-', ' ', $q);
            $qSeparate = explode(' ', $tmpQ);
            $qSeparate = implode(' +', $qSeparate);

            $user = Auth::user();

            if ($typeId) {
                $posts = $posts
                    ->where(function ($query) use ($q, $qSeparate, $id, $typeId, $user) {
                        $query->where(function ($qr) use ($q, $qSeparate) {
                            $qr->where('name', 'LIKE', '%' . $q . '%')->orWhereRaw("MATCH (name) AGAINST (? IN BOOLEAN MODE)", $qSeparate);
                        })
                            ->orWhere('id', strval($q))
                            ->orWhere(function ($qr) use ($id, $typeId) {
                                $qr->where('id_by_category', $id)->where('category_id', $typeId);
                            });

                        if ($user != null) {
                            $query->orWhere('owner_phone', strval($q));
                        }
                    });
            } else {
                $posts = $posts->where(function ($query) use ($q, $qSeparate, $user) {
                    $query->where('name', 'LIKE', '%' . $q . '%')
                        ->orWhereRaw("MATCH (name) AGAINST (? IN BOOLEAN MODE)", $qSeparate);

                    if ($user != null) {
                        $query->orWhere('owner_phone', strval($q));
                    }
                });
            }
        }

        // dd($posts->toSql(), $posts->getBindings());
        // echo $posts->count();

        if ($location && $location != '-1') {
            if (gettype($location) == 'string') {
                $posts = $posts->where('ward_id', $location);
            } else {
                $posts = $posts->whereIn('ward_id', $location);
            }
        }

        if ($category && $category != '-1') {
            if (gettype($category) == 'string') {
                $posts = $posts->where('category_id', $category);
            } else {
                $posts = $posts->whereIn('category_id', $category);
            }
        }

        if ($duration && $duration != '-1') {
            if (gettype($duration) == 'string') {
                $posts = $posts->where('duration_id', $duration);
            } else {
                $posts = $posts->whereIn('duration_id', $duration);
            }
        }

        if ($price) {
            $priceRange = explode('-', $price);

            if ($priceRange && count($priceRange) == 2) {
                $min = (float) $priceRange[0];
                $max = (float) $priceRange[1];

                $ONE_MILLION = 1000000;

                if ($min) {
                    $posts = $posts->where('price', '>=', $min * $ONE_MILLION);
                }

                if ($max) {
                    $posts = $posts->where('price', '<=', $max * $ONE_MILLION);
                }
            }
        }

        if ($acreage) {
            $posts = $posts->where('acreage', $acreage);
        }

        if ($bedroom) {
            $posts = $posts->where('bedroom', $bedroom);
        }

        if ($toilet) {
            $posts = $posts->where('toilet', $toilet);
        }

        if ($floor) {
            $posts = $posts->where('floor', $floor);
        }

        $posts = $posts->orderBy('updated_at', 'desc');
        // dd($posts->toSql(), $posts->getBindings());
        $posts = $posts->paginate(12);

        if ($request->ajax()) {
            $view = view('components.common.post-list', compact('posts'))->render();
            return response()->json(['html' => $view]);
        }

        $posts->appends(['q' => $q]);
        $posts->appends(['location' => $location]);
        $posts->appends(['category' => $category]);
        $posts->appends(['price' => $price]);
        $posts->appends(['acreage' => $acreage]);
        $posts->appends(['bedroom' => $bedroom]);
        $posts->appends(['toilet' => $toilet]);
        $posts->appends(['floor' => $floor]);

        if (!$posts->isEmpty()) {
            $images = $posts[0]->images;
            if (count($images)) {
                $ogImage = $request->getSchemeAndHttpHost() . '/uploads/' . $posts[0]->images[0]->filename;
            } else {
                $ogImage = $request->getSchemeAndHttpHost() . '/uploads/logo.jpg';
            }
        } else {
            $ogImage = $request->getSchemeAndHttpHost() . '/uploads/logo.jpg';
        }

        $seo = (object) [
            'title' => 'Danh sách nhà cho thuê',
            'description' => 'Cho thuê nhà đất thành phố Nha Trang giá rẻ',
            'ogUrl' => route('home'),
            'ogTitle' => 'Cho thuê nhà đất thành phố Nha Trang giá rẻ',
            'ogImage' => $ogImage,
        ];

        return view('pages.bai-dang.list', compact('seo', 'posts', 'categories', 'wards', 'latestPosts', 'postRequestTypes', 'durations'));
    }

    public function post(Request $request, Post $post)
    {
        $images = $post->images;
        if (count($images)) {
            $ogImage = $request->getSchemeAndHttpHost() . '/uploads/' . $post->images[0]->filename;
        } else {
            $ogImage = $request->getSchemeAndHttpHost() . '/uploads/logo.jpg';
        }

        $seo = (object) [
            'title' => $post->name,
            'description' => 'Cho thuê nhà đất thành phố Nha Trang giá rẻ',
            'ogUrl' => request()->url(),
            'ogTitle' => $post->name,
            'ogImage' => $ogImage,
        ];

        $postRequestTypes = PostRequestType::all();
        $posts = Post::where('is_hide', 0)->where('verify_status', 0)->paginate(12);
        $categories = Category::where('is_hide', 0)->orderBy('name', 'asc')->get();
        $wards = Ward::where('is_hide', 0)->get();
        $latestPosts = Post::orderBy('created_at', 'desc')
            ->where('is_hide', 0)
            ->where('verify_status', 0)
            ->where('id', '!=', $post->id)
            ->paginate(3);

        $relatedPosts = Post::where('ward_id', $post->ward_id)
            ->where('is_hide', 0)
            ->where('verify_status', 0)
            ->where('id', '!=', $post->id)
            ->paginate(4);

        $phoneNumbers = array(
            array("0797.016.179", "0797016179"),
            array("0797.018.179", "0797018179")
        );
        $replacePhoneNumber = ["0️⃣7️⃣9️⃣7️⃣0️⃣1️⃣6️⃣1️⃣7️⃣9️⃣", "0️⃣7️⃣9️⃣7️⃣0️⃣1️⃣8️⃣1️⃣7️⃣9️⃣"];
        $totalPost = Post::where('is_hide', 0)->where('verify_status', 0)->where('user_id', $post->user_id)->count();

        foreach ($phoneNumbers as $i => $phoneNumber) {
            foreach ($phoneNumber as $number) {
                $post["description"] = str_replace($number, $replacePhoneNumber[$i], $post["description"]);
            }
        }

        return view('pages.bai-dang.detail', compact('seo', 'post', 'posts', 'categories', 'wards', 'latestPosts', 'relatedPosts', 'postRequestTypes', 'totalPost'));
    }

    public function update(Request $request)
    {
        // reset categories count
        // update post id via category
        // $categories = Category::all();
        // foreach ($categories as $category) {
        //     $posts = Post::where('category_id', $category->id);
        //     $counter = 0;

        //     foreach ($posts as $post) {
        //         $counter++;
        //         $post->id_by_category = $counter;
        //         $post->save();
        //     }

        //     $category->count = $posts->count();
        //     $category->save();
        // }


        // generate image by category and post id
        // remove old image
        $id = (int) $request->id;
        if ($id == null) {
            return "id is null";
        }

        $postImages = PostImage::where('id', '>', $id)->limit(200)->get();

        foreach ($postImages as $postImage) {
            if ($postImage->post) {
                GenerateImageHelper::generate($postImage->id, $postImage->post);
            }
        }

        return 'Done ' . $postImages->count();
    }

    public function removeUnusedImages()
    {
        $filesInFolder = \Storage::allFiles(public_path('uploads'));

        foreach ($filesInFolder as $path) {
            $file = pathinfo($path);
            $filename = $file['basename'];

            if ($filename == 'logo.jpg') {
                continue;
            }

            $image = PostImage::where('filename', $filename)->orWhere('originalFilename', $filename)->first();

            if (!$image) {
                unlink(public_path('uploads') . '/' . $filename);
                echo $filename . ' không được sử dụng';
            }
        }

        $filesInFolder = array_diff(scandir(public_path()), array('.', '..'));

        foreach ($filesInFolder as $path) {
            $file = pathinfo($path);
            $filename = $file['basename'];

            if (!is_dir($filename) && !empty($file['extension'])) {
                $fileExtension = $file['extension'];

                if ($fileExtension == 'zip') {
                    unlink(public_path('') . '/' . $filename);
                    echo $filename . ' không được sử dụng';
                }
            }
        }
    }
}
