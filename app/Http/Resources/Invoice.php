<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Invoice extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->Id,
            'invoice_no' => $this->Inv_No,
            'mykad' => $this->MyKad_SSM,
            'date' => $this->Date->format('d/m/Y'),
        ];
        // return parent::toArray($request);
    }
}
