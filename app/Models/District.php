<?php

namespace App\Models;

use App\Models\DistrictType;
use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(DistrictType::class);
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
}
