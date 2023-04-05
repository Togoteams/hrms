<?php

namespace App\Http\Resources\Admin\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'role_id'=> $this->id,
            'name'=> $this->name,
            'short_code'=> $this->short_code,
            'role_type'=> $this->role_type,
            'description'=> $this->description,

        ];
    }
}
