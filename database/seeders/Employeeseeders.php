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
            'name' =>  'Rohit kumar',
            'username' => "rohit83013",
            'email' =>    "rohit83013@gmail.com",
            'mobile' =>  "72504942",
            'password' => "Rohit83013@#",
            'designation_id' => 1,
            'employment_type' =>  'local',
            'ec_number' => '0023',
            'gender' =>  'male',
            'emergency_contact' => '7250634942',
            'id_number' =>  012,
            'contract_duration' =>  2,
            'basic_salary' => 200000,
            'date_of_current_basic' =>   date('Y-m-d'),
            'date_of_birth' =>  date('Y-m-d'),
            'start_date' =>   date('Y-m-d'),
            'branch_id' =>   1,
            'pension_contribution' => 1000,
            'union_membership_id' =>   1,
            'amount_payable_to_bomaind_each_year' =>  200,
            'currency' => 'INR',
            'bank_account_number' => '7250634942',
        ],
        [
            'name' =>  'Amit Prajapati',
            'username' => "amitraja",
            'email' =>    "amitraja@gmail.com",
            'mobile' =>  "72504942",
            'password' => "amitraja@gmail.com",
            'designation_id' => 1,
            'employment_type' =>  'expatriate',
            'ec_number' => '0024',
            'gender' =>  'male',
            'emergency_contact' => '7250634942',
            'id_number' =>  012,
            'contract_duration' =>  2,
            'basic_salary' => 200000,
            'date_of_current_basic' =>   date('Y-m-d'),
            'date_of_birth' =>  date('Y-m-d'),
            'start_date' =>   date('Y-m-d'),
            'branch_id' =>   1,
            'pension_contribution' => 1000,
            'union_membership_id' =>   1,
            'amount_payable_to_bomaind_each_year' =>  200,
            'currency' => 'INR',
         
            'bank_account_number' => '7250634942',
            
            

        ],
        [
            'name' =>  'Surya',
            'username' => "Surya",
            'email' =>    "Surya@gmail.com",
            'mobile' =>  "72504942",
            'password' => "Surya@gmail.com",
            'designation_id' => 1,
            'employment_type' =>  'local',
            'ec_number' => '0025',
            'gender' =>  'male',
            'emergency_contact' => '7250634942',
            'id_number' =>  012,
            'contract_duration' =>  2,
            'basic_salary' => 200000,
            'date_of_current_basic' =>   date('Y-m-d'),
            'date_of_birth' =>  date('Y-m-d'),
            'start_date' =>   date('Y-m-d'),
            'branch_id' =>   1,
            'pension_contribution' => 1000,
            'union_membership_id' =>   1,
            'amount_payable_to_bomaind_each_year' =>  200,
            'currency' => 'INR',
         
            'bank_account_number' => '7250634942',
            
            

        ]
    );

        foreach ($employee_array as $emp) {
            $emp = (object)$emp;
            $user = User::create([
                'name' => $emp->name,
                'email' => $emp->email,
                'username' => $emp->username,
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
                $role_id = Role::where('short_code', 'employee')->value('id');
                $user->roles()->sync($role_id);
            } catch (Exception $e) {
                User::destroy($user->id);
            }
        }
    }
}
