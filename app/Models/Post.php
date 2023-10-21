<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {

    use HasFactory;
    use SoftDeletes;

//    protected $guarded = [''];
    protected $dates = ['deleted_at'];

    public function getImgPostAttribute($value) {
        if ($value) {
            return asset('storage/app/public/images/posts/' . $value);
        } else {
            return asset('storage/app/public/images/no-image.png');
        }
    }

}
