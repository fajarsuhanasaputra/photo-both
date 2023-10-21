<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoothResource extends JsonResource
{

  public function toArray($request)
  {

    return [
      'id' => $this->id,
      'booth_name' => $this->booth_name,
      'address' => $this->address,
      'person_in_charge' => $this->person_in_charge,
      'contact_person' => $this->contact_person,
      'created_at' => $this->created_at,
    ];
  }
}
