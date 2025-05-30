<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Permission extends Model
{
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    protected $fillable =[
        'name',
        'module',
        'permissions_for'
    ];

    public function scopeNotDashboard($query){
        return $query->whereNotIn('slug', ['view-dashboard']);
    }

    public function roles() {
        return $this->belongsToMany(Role::class,'roles_permissions');
    }
}
