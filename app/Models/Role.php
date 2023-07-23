<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Webpatser\Uuid\Uuid;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
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
        'short_code',
        'status',
        'role_type',
        'description'
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
    public function scopeGetRoles($query)
    {
        return $query->where('status', 'active');
    }
 

    public function permissions() {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }

    public function getAllPermissions(array $permissions){
        return Permission::whereIn('slug',$permissions)->get();
    }

    public function hasPermission($permission){
        return (bool) $this->permissions->where('slug', $permission)->count();
    }

    public function givePermissionsTo($permissions){
        // dd($permissions);
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }
}
