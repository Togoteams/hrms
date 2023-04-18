<?php

namespace App\Http\Resources\Admin\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user_id'=> $this->id,
            'last_name'=> $this->last_name,
            'first_name'=> $this->first_name,
            'role_id'=> $this->roles->first()->id,
            'name'=> $this->name,
            'username'=> $this->username,
            'email'=> $this->email,
            'mobile'=> $this->mobile,
            'email_verified_at'=> $this->email_verified_at,
            // 'password'=> $this->password,
            'status'=> $this->status,

        ];
    }
}
