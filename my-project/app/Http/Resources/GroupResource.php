<?php

namespace App\Http\Resources;

use App\Models\Expenses;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            'user' => new UserResource($this->user),
            'members' => UserResource::collection($this->whenLoaded('members')),
            'expenses' => ExpenseResource::collection($this->whenLoaded('expenses')),

        ];
    }
}
