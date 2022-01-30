<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'invites' => new RequestResource($this->load('invites')),
            'comings' =>  TransactionResource::collection($this->comings),
            'spends' =>  TransactionResource::collection($this->spends),

        ];
    }
}
