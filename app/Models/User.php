<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasRolesAndPermissions;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRolesAndPermissions;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'first_name',
        'last_name',
        'full_name',
        'role', // role -> name
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Set the user's first name.
     *
     * @param  string $value
     * @return void
     */
    public function getFirstNameAttribute()
    {
        if (!empty($this->name)) {
          $arr = splitName($this->name);
          return $arr[0];
        }
        return ;
    }

    /**
     * Set the user's last name.
     *
     * @param  string $value
     * @return void
     */
    public function getLastNameAttribute()
    {
        if (!empty($this->name)) {
          $arr = splitName($this->name);
          return $arr[1];
        }
        return ;
    }

    /**
     * Set the user's full name.
     *
     * @param  string $value
     * @return void
     */
    public function getFullNameAttribute()
    {
        return "{$this->name}";
    }
    /**
     * Set the user's role name.
     *
     * @param  string $value
     * @return void
     */
    public function getRoleAttribute()
    {
        return $this->roles ? $this->roles?->first()?->name : "";
        // return Role::find($this->role_id)->name;
    }

  
    
    public function media()
    {
        return $this->morphOne('App\Models\Media', 'table')->where('deleted_at', null)->orderBy('id', 'DESC');
    }
}
