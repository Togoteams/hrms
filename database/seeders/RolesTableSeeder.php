<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $permissions= Permission::get();
        $json  = file_get_contents(database_path() . '/data/roles.json');
        $data  = json_decode($json);
        $permissions= Permission::get();

        foreach ($data->roles as $key => $value) {
            Role::updateOrCreate([
                'name'=> $value->name,
                'short_code'=> $value->short_code,
                'role_type'=> $value->role_type,
                'is_system_define'=> 1,
            ]);
        }
        $role= Role::find(1);
        $role->permissions()->attach($permissions);
    }
}

