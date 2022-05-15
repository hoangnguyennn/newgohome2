<?php

namespace App\Models;

use App\Models\District;
use App\Models\WardType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(WardType::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
