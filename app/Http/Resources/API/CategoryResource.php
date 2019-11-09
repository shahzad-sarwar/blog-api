<?php

namespace App\Http\Resources\API;

use App\Http\Resources\API\PostResource;
use App\Http\Resources\API\UserResource;
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
            'created_by' => $this->when(
                auth()->user() && auth()->user()->hasAnyRole(['super-admin', 'manager']),
                new UserResource($this->user)
            ),
            'posts' => PostResource::collection(
                $this->whenLoaded('posts')
            ),
        ];
    }
}
