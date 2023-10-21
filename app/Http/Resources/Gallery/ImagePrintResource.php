<?php

namespace App\Http\Resources\Gallery;

use Illuminate\Http\Resources\Json\JsonResource;

class ImagePrintResource extends JsonResource {

    public function toArray($request) {
        return [
            'id' => $this->id,
            'transaksi_id' => $this->transaksi_id,
            'img_data' => asset('storage/app/public/images/list-contacts/' . $this->code . '/' . $this->img_data),
        ];
    }

}
