<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model {

    use HasFactory;

    protected $guarded = [''];

    public function ScopeLatest($query) {
        $query->orderBy('created_at', 'desc');
    }

    public function getImgFrameLeftAttribute($value) {
        if ($value) {
            return asset('storage/images/frame/' . $value);
        } else {
            return asset('storage/images/no-image.png');
        }
    }

    public function getImgFrameRightAttribute($value) {
        if ($value) {
            return asset('storage/images/frame/' . $value);
        } else {
            return asset('storage/images/no-image.png');
        }
    }

}
