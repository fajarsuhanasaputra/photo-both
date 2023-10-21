<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingDefault extends Model {

    use HasFactory;

    protected $guarded = [''];
    protected $appends = ['harga_format'];
    
    public function getImgBackgroundAttribute($value) {
        if ($value) {
            return asset('storage/app/public/images/background/' . $value);
        } else {
            return asset('storage/app/public/images/no-image.png');
        }
    }

    public function getHargaFormatAttribute() {
        return 'IDR. ' . number_format($this->price);
    }

    public function getImgLogoAttribute($value) {
        if ($value) {
            return asset('storage/app/public/images/logo/' . $value);
        } else {
            return asset('storage/app/public/images/no-image.png');
        }
    }

}
