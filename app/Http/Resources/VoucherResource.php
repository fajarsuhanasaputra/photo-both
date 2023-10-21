<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResource extends JsonResource {

    public function toArray($request) {

        return [
            'id' => $this->id,
            'code' => $this->code,
            'type' => $this->type,
            'value' => $this->value,
            'start' => $this->start,
            'expired' => $this->expired,
//            'maxUse' => $this->maxUse,
//            'created_at' => $this->created_at,
        ];
    }

}
