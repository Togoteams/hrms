<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RolesPermissions;
use App\Models\Role;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = Role::get();
        foreach($roles as $role)
        {
            $rolePermissionArray = Permission::whereRaw('JSON_CONTAINS(permissions_for, ?)', [json_encode($role->role_type)])->pluck('slug')->toArray();
            $role->permissions()->detach();
                $isPermissionAttached = $role->givePermissionsTo( (array) $rolePermissionArray);
        }
    }
}
