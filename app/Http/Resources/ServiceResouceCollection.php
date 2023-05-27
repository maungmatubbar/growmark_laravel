<?php

namespace App\Http\Resources;

use App\CustomResource\PaginationResource;
use Illuminate\Http\Request;
//use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceResouceCollection extends PaginationResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'service_list' => ServiceResouce::collection($this->collection),
            'pagination' => $this->pagination
        ];
    }
}
