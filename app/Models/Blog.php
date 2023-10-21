<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booth extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getImgBackgroundAttribute($id, $value)
    {
        if ($value) {
            return asset('storage/app/public/images/background/'.$id.'/'.$value);
        } else {
            return asset('storage/app/public/images/no-image.png');
        }
    }

    public function getHargaFormatAttribute()
    {
        return 'IDR. ' . number_format($this->price);
    }

    public function getImgLogoAttribute($id, $value)
    {
        if ($value) {
            return asset('storage/app/public/images/logo/'.$id.'/'.$value);
        } else {
            return asset('storage/app/public/images/no-image.png');
        }
    }
}
