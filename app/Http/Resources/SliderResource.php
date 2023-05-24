<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
          'slider_id' => $this->id,
          'title' => $this->title,
          'description' => $this->description,
          'link' => $this->link,
          'image' => $this->image,
        ];
    }
}