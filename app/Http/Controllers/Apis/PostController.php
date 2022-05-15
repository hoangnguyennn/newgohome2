<?php

namespace App\Http\Controllers\Apis;

use App\Exports\PostsExport;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Excel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->token;
        if ($token && $token === 'RkLVhQwFlw2FxtXqukH2Uj6DvnbSVKERSQKN6RgiYvF4dZNJ1oRljC15zXrK') {
            $posts = Post::with('images')->with('category')
                ->where('verify_status', '0')
                ->where('is_hide', '0')
                ->where('is_featured', '1')
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();
            $posts2 = Post::with('images')->with('category')
                ->where('verify_status', '0')
                ->where('is_hide', '0')
                ->where('is_featured', '0')
                ->orderBy('id', 'asc')
                ->get()
                ->toArray();
            $posts = array_merge($posts, $posts2);
            $phoneNumbers = array(
                array("0797.016.179", "0797016179"),
                array("0797.018.179", "0797018179")
            );
            $replacePhoneNumber = ["0️⃣7️⃣9️⃣7️⃣0️⃣1️⃣6️⃣1️⃣7️⃣9️⃣", "0️⃣7️⃣9️⃣7️⃣0️⃣1️⃣8️⃣1️⃣7️⃣9️⃣"];
            
            foreach($posts as $index => $post) {
                foreach($phoneNumbers as $i => $phoneNumber) {
                    foreach($phoneNumber as $number) {
                        $posts[$index]["description"] = str_replace($number, $replacePhoneNumber[$i], $posts[$index]["description"]);
                    }
                }
            }
            
            foreach($posts as $index => $post) {
                $pie = explode("\r\n", $post["description"]);
                $code = "- Mã nhà: ".$post["category"]["shorthand"].'-'.$post["id_by_category"];
                
                array_splice($pie, 1, 0, $code);
                // var_dump($pie);
                $posts[$index]["description"] = implode("\r\n", $pie);
            }
            
            return $posts;
        }

        return [];
    }

    public function featured()
    {
        $posts = Post::with('images')->with('category')
            ->where('verify_status', '0')
            ->where('is_hide', '0')
            ->where('is_featured', '1')
            ->get();
        return $posts;
    }

    public function downloadImages(Post $post)
    {
        $zip = new \ZipArchive();
        $fileName = Str::slug($post->name) . '-' . Carbon::now()->format('Y-m-d') . '.zip';

        if ($zip->open(public_path($fileName), \ZipArchive::CREATE) == true) {
            $postImages = $post->images;
            foreach ($postImages as $image) {
                $file = public_path('uploads/' . $image->filename);
                $relativeName = basename($file);
                $zip->addFile($file, $relativeName);
            }

            $zip->close();
        }

        return response()->download(public_path($fileName));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new PostsExport($request->id), 'ds-bai-dang.xlsx');
    }
}
