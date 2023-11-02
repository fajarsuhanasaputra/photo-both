<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Free extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getImgBgAttribute($value)
    {
        if ($value) {
            return asset('storage/images/background/' . $value);
        } else {
            return asset('storage/images/no-image.png');
        }
    }

    public function getHargaFormatAttribute()
    {
        return 'IDR. ' . number_format($this->price);
    }

    public function getImgLgAttribute($value)
    {
        if ($value) {
            return asset('storage/images/logo/' . $value);
        } else {
            return asset('storage/images/no-image.png');
        }
    }
}
