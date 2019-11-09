<?php

namespace App\Http\Resources\API;

use App\Http\Resources\API\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivateUserResource extends UserResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return array_merge(parent::toArray($request), [
             'assigned_roles' => $this->when(auth()->user()->hasAnyRole(['super-admin']), $this->roles->pluck('name')),
        ]);
    }
}
