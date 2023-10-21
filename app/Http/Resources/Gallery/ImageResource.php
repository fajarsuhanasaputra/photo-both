<?php

namespace App\Http\Resources\Gallery;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource {

    public function toArray($request) {
        return [
            'id' => $this->id,
//            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
//            'kritik_saran' => $this->kritik_saran,
            'img_data' => asset('storage/app/public/images/gallery/' . $this->code .'/' . $this->img_data),
        ];
    }

}
