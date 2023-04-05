<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HolidayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'holiday_id'=> $this->id,
            'name'=> $this->name,
            'date'=> $this->date,
            'is_optional'=> $this->is_optional,
            'description'=> $this->description,

        ];
    }
}
