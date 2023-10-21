<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Voucher extends Model {

    use HasFactory;

    protected $guarded = [''];

    public function ScopeLatest($query) {
        $query->orderBy('created_at', 'desc');
    }

    public function getCreatedAtAttribute() {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('d F Y');
    }

    public static function findByCode($code) {
        return self::where('code', $code)->first();
    }

    public function discount($total) {
        if ($this->type == 'fixed') {
            return $this->value;
        } elseif ($this->type == 'percent') {
            return ($this->percent_off / 100) * $total;
        } else {
            return 0;
        }
    }

}
