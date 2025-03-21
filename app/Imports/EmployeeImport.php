<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Designation;
use App\Models\EmpAddress;
use Illuminate\Support\Collection;
use App\Models\Employee;
use App\Models\Role;
use App\Models\SalaryHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EmployeeImport implements ToModel, WithHeadingRow,WithMultipleSheets,WithCalculatedFormulas
{
   
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }
    public function model(array $row)
    {
        set_time_limit(0);
        // dd($row['employment_type']);
          // Check if all values in the row are empty
        if (empty(array_filter($row))) {
            return null; // Skip this row if all values are empty
        }
        if($row['employee_name'] && $row['email'] && $row['mobile_no'])
        {
            $faker = Faker::create();
            $userData =[
                "name"=>$row['employee_name'],
                "email"=>$row['email'],
                "mobile"=>$row['mobile_no'],
                "email_verified_at"=>$faker->dateTime(),
                "password"=>Hash::make('User@123'),
            ];
            $dateOfBirth = @$row["date_of_birth"];
            $dateOfJoining = @str_replace(".",'-', $row["date_of_joining"]);
            if(!empty(@$row["date_of_birth"]) && !is_string(@$row["date_of_birth"]))
            {
                $dateOfBirth = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(@$row["date_of_birth"]));
                $dateOfBirth = date('Y-m-d',strtotime($dateOfBirth));
            }
            
            if(!empty(@$row["date_of_joining"]) &&  !is_string(@$row["date_of_joining"]))
            {
                $dateOfJoining = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(@$row["date_of_joining"]));
                $dateOfJoining = date('Y-m-d',strtotime($dateOfJoining));
            }
            $role = Role::where('slug', str::slug($row['role']))->first();
            $user = User::updateOrCreate(['email'=>$row['email']],$userData);
            if($user){
                if($role)
                {
                    $user->roles()->attach($role);
                }
                $designation = Designation::where('slug', str::slug($row['designation']))->first();
                $branch = Branch::where('name', $row['branch'])->first();
                $employmentType = str::slug($row['employment_type']);
                if($employmentType=="local-confirmed")
                {
                    $employmentType = 'local';
                }elseif($employmentType=="local-contractual")
                {
                    $employmentType = 'local';
                }else
                {
                    $employmentType = $employmentType; 
                }
                $employeeData =[
                    "user_id"=>$user->id,
                    "emp_id"=>'emp-' . date('Y') . "-" . $user->id,
                    "designation_id"=>$designation?->id,
                    "date_of_birth"=>$dateOfBirth,
                    "gender"=> str::lower($row['gender']),
                    "marital_status"=> str::lower($row['marital_status']),
                    "emergency_contact"=>$row['emergency_contact_no'],
                    "ec_number"=>$row['ec_number'],
                    "start_date"=>$dateOfJoining,
                    "employment_type"=>$employmentType,
                    "bank_account_number"=>$row['bank_account_no'],
                    "place_of_domicile"=>$row['place_of_domicile'],
                    "branch_id"=>$branch?->id,
                ];
                $employee = Employee::updateOrCreate(['user_id'=>$user->id],$employeeData);
                Log::info("employee" . ($employee));
                $salaryData = [
                    'basic_salary'=>$row['basic_salary'],
                    'date_of_current_basic'=>date('Y-m-d'),
                    'user_id'=>$user->id,
                    'currency_salary'=>(str::lower($row['employment_type'])=="expatriate") ? "usd" : "pula",
                    'pension_contribution'=>str::lower($row['is_pension_contribution']),
                    'pension_opt'=>(int)$row['pension_contribution_percantage'],
                    'union_membership_id'=>str::lower($row['is_union_membership']),
                ];
                $salaryData = SalaryHistory::updateOrCreate(['user_id'=>$user->id],$salaryData);
                $addressData =[
                    'address'=>$row['address'],
                    'city'=>$row['city'],
                    'user_id'=>$user->id,
                    'state'=>$row['state'],
                    'country'=>$row['country'],
                ];
                $addressData = EmpAddress::updateOrCreate(['user_id'=>$user->id],$addressData);
            }
        }
            return null;

    }
    // }
}
