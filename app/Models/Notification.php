<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description','user_id','notification_type','notifi_from_user_id', 'reference_type', 'reference_id', 'membership_code'];

    public function leaveApply()
    {
        return $this->morphToMany(LeaveApply::class, 'reference');
    }
    public function scopeGetList($q){
        // $user = User::find(auth()->id());
        // if(isemplooye())
        // {

        // }
        return $q->where('user_id',auth()->id());
    }
}
