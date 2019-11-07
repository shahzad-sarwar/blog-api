<?php

namespace App\Http\Resources\API;

use App\Http\Resources\API\PostResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'posts' => PostResource::collection(
                $this->whenLoaded('posts')
            ),
        ];
    }
}