<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $isAdminRole = Role::where('slug', 'admin')->first();
        

        $user = new User();
        $user->uuid = $faker->uuid;
        $user->name = 'Admin';
        $user->username = 'admin-togoteams';
        $user->email = 'admin@togoteams.com';
        $user->mobile = 9999988888;
        $user->email_verified_at = $faker->dateTime();
        $user->password = Hash::make('User@123');
        if($user->save()){
            $user->roles()->attach($isAdminRole);
            $permissions= Permission::get();
            $user->permissions()->attach($permissions);

            // $roleData = ['role_id'=> $isAdminRole->id,'id'=>1];
            // $user->usersRoles()->create($roleData);
        }
    }
}
