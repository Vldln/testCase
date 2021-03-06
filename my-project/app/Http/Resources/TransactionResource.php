<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'id' => $this->id,
            'pay_amount' =>  $this->pay_amount,
            'recipient' =>  $this->recipient->name,
            'user' => $this->user->name,
            'groups_id' => $this->groups_id,

        ];
    }
}
