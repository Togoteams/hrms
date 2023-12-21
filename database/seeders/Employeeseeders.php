<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\Role;
use Exception;

class Employeeseeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee_array = array([
            'name' =>  'Sanjay Jhosi',
            'username' => "admin@bobhrms.com",
            'email' =>    "admin@bobhrms.com",
            'mobile' =>  "9999988888",
            'password' => "User@123",
            'designation_id' => 1,
            'employment_type' =>  'expatriate',
            'ec_number' => '0001',
            'gender' =>  'male',
            'emergency_contact' => '9999988888',
            'id_number' =>  012,
            'branch_id' =>   1
        ]
    );

        foreach ($employee_array as $emp) {
            $emp = (object)$emp;
            $user = User::create([
                'name' => $emp->name,
                'email' => $emp->email,
                // 'username' => $emp->username,
                'mobile' => $emp->mobile,
                'password' => Hash::make($emp->password),
            ]);
            unset($emp->name);
            unset($emp->email);
            unset($emp->username);
            unset($emp->mobile);
            unset($emp->password);
            try {
                $emp->user_id = $user->id;
                $emp->emp_id = 'emp-' . date('Y') . "-" . Employee::count('emp_id') + 1;
                Employee::insertGetId((array)$emp);
                $role_id = Role::where('slug', 'managing-director')->value('id');
                $user->roles()->sync($role_id);
            } catch (Exception $e) {
                User::destroy($user->id);
            }
        }
    }
}
