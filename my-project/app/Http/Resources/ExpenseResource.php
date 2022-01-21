<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'description' => $this->name,
            'split_options' => new SplitOptionResource($this->splitOption),
            'created_at' => $this->created_at,
            'amount' => $this->amount,
            'group' => new GroupResource($this->group)
        ];
    }
}
