<?php

namespace App\Models;

use App\Models\Category;
use App\Models\PostImage;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_update()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->hasOne(PostVideo::class);
    }
}
