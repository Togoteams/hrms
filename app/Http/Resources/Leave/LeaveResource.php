<?php

namespace App\Http\Resources\Leave;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveResource extends JsonResource
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
            'leave_id'=>$this->id,
            'leave_applies_for'=>$this->leave_applies_for,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'is_approved'=>$this->is_approved,
            'approved_by'=>$this->approved_by,
            'approved_date'=>$this->approved_date,
            'is_paid'=>$this->is_paid,
              'leave_reason'=>$this->leave_reason,
              'apply_date'=>$this->apply_date,
              'remark'=>$this->remark,

        ];
    }
}
