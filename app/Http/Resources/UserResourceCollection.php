<?php

namespace App\Http\Resources;

use App\CustomResource\PaginationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResourceCollection extends PaginationResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_list' => UserResource::collection($this->collection),
            'pagination' => $this->pagination
        ];
    }
}
