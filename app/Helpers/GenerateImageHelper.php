<?php

namespace App\Helpers;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Support\Str;
use Image;
use Exception;

class GenerateImageHelper
{
    /**
     * generate post image with watermark and unlink old image
     */
    public static function generate($id, Post $post)
    {
        try {
            $image = PostImage::findOrFail($id);
            $filename = $image->originalFilename;

            if (file_exists(public_path('/uploads/' . $filename))) {
                $file = Image::make(public_path('/uploads/' . $filename));
                $file->orientate();
                // $file->insert(public_path('/images/watermark/go_home_hotline_3.png'), 'bottom-left', 10, 10);
                $file->insert(public_path('/images/watermark/go_home_logo_3d.png'), 'center', 0, 0);

                // $prefix = self::generateCode($post->category_id);

                // $file->text($prefix . '-' . $post->id_by_category, 10, 10, function ($font) {
                //     $font->file(public_path('/fonts/Roboto-Regular.ttf'));
                //     $font->size(60);
                //     $font->color('#fff');
                //     $font->align('left');
                //     $font->valign('top');
                // });

                unlink(public_path('uploads') . '/' . $image->filename);
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $newfilename = Str::uuid() . '.' . $extension;
                $image->filename = $newfilename;
                $image->save();
                $file->save(public_path('uploads') . '/' . $newfilename);
                return 1;
            } else {
                echo $image->id . ' không tồn tại';
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public static function generateCode($typeId)
    {
        switch ($typeId) {
            case 1:
                return 'MB';
            case 2:
                return 'CH';
            case 3:
                return 'NCT';
            case 4:
                return 'KX';
            case 5:
                return 'NT';
            case 6:
                return 'VI';
            case 7:
                return 'STU';
            default:
                return 'GH';
        }
    }

    public static function getTypeId($code)
    {
        switch ($code) {
            case 'MB':
                return 1;
            case 'CH':
                return 2;
            case 'NCT':
                return 3;
            case 'KX':
                return 4;
            case 'NT':
                return 5;
            case 'VI':
                return 6;
            case 'STU':
                return 7;
            default:
                null;
        }
    }
}
