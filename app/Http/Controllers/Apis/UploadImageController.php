<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\PostImage;
use App\Models\PostVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadImageController extends Controller
{
    public function uploadSingle(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file;

            $extension = $image->getClientOriginalExtension();
            $imageName = Str::uuid() . '.' . $extension;
            $baseName = Str::uuid() . '.' . $extension;

            $image->move(public_path('uploads'), $imageName);

            // copy file to another for backup
            copy(public_path('uploads') . '/' . $imageName, public_path('uploads') . '/' . $baseName);

            $imageUpload = new PostImage;
            $imageUpload->filename = $imageName;
            $imageUpload->originalFilename = $baseName;
            $imageUpload->save();

            return $imageUpload->id;
        }

        return response('nothing', 404);
    }

    public function uploadVideo(Request $request)
    {
        if ($request->hasFile('file')) {
            $video = $request->file;

            $extension = $video->getClientOriginalExtension();
            $videoName = Str::uuid() . '.' . $extension;

            $video->move(public_path('uploads'), $videoName);

            $videoUpload = new PostVideo;
            $videoUpload->filename = $videoName;
            $videoUpload->save();

            return $videoUpload->id;
        }

        return response('nothing', 404);
    }
}
