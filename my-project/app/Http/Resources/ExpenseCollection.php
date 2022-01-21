<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpenseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'count' => $this->count(),
            'total' => $this->total(),
            'per_page'  => $this->perPage(),
            'current_page'  => $this->currentPage(),
            'last_page'  => $this->lastPage(),
            'data' =>  $this->collection
        ];
    }
}