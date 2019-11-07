<?php

namespace App\Http\Resources\API;

use App\Http\Resources\API\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostResource extends JsonResource
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
            'body' => $this->body,
            'image' => env('APP_URL').Storage::url($this->image),
            'categories' => $this->categories,
            'auther' => new UserResource($this->author),
        ];
    }
}
