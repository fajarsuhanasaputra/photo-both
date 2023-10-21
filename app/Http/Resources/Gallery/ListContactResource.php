<?php

namespace App\Http\Resources\Gallery;

use Illuminate\Http\Resources\Json\JsonResource;

class ListContactResource extends JsonResource {

    public function toArray($request) {
        return [
        'id' => $this->id, 
        'image_print_id' => $this->image_print_id,
        'transaksi_id' => $this->transaksi_id,
        'name' => $this->name,
        'phone' => $this->phone,
        'email' => $this->email,
//            'img_data' => asset('storage/app/public/images/list-contacts/' . $this->code . '/' . $this->img_data),
        'img_print' => $this->img_print,
        'kritik_saran' => $this->kritik_saran,
        ];
    }

}
