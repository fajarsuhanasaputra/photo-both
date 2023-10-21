<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FrameResource extends JsonResource {

    public function toArray($request) {

        return [
//            'id' => $this->id,
            'name' => $this->name,
            'size' => $this->size,
            'order_number' => $this->order_number,
            'img_frame_left' => asset($this->img_frame_left),
            'img_frame_right' => asset($this->img_frame_right),
        ];
    }

}
