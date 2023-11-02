<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
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
        'status',
        'file',
        'salutation',
        // 'first_name',
        // 'last_name',

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
    public function payrollPayscale()
    {
        return $this->hasOne(PayRollPayscale::class,'user_id');
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }

    public function departmentHistory()
    {
        return $this->hasMany(EmpDepartmentHistory::class, 'user_id')
            ->latest('created_at'); // Retrieve the latest department history entry
    }
    public function employee()
    {
        return $this->hasOne(Employee::class,'user_id');
    }
    

    public function latestDepartmentHistory(): HasMany
    {
        return $this->hasMany(EmpDepartmentHistory::class, 'user_id')
            ->selectRaw('emp_department_histories.*')
            ->join(DB::raw('(SELECT user_id, MAX(created_at) AS max_created_at FROM emp_department_histories GROUP BY user_id) latest_history'), function ($join) {
                $join->on('emp_department_histories.user_id', '=', 'latest_history.user_id')
                     ->on('emp_department_histories.created_at', '=', 'latest_history.max_created_at');
            });
    }

    
    public function media()
    {
        return $this->morphOne('App\Models\Media', 'table')->where('deleted_at', null)->orderBy('id', 'DESC');
    }


}
