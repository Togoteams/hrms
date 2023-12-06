<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            ['name'=>"Salaries",'slug'=>"salaries",'account_number'=>'95212352401001','account_type'=>"office",'is_credit'=>0,"description"=>"This is Account store Employee Basic Salary"],
            ['name'=>"Entertainment",'slug'=>"entertainment",'account_number'=>'95212352401010','account_type'=>"office",'is_credit'=>0,"description"=>"This is Account store Entertainment Amount"],
            ['name'=>"Education",'slug'=>"education",'account_number'=>'95212352451009','account_type'=>"office",'is_credit'=>0,"description"=>"This is Account store Education Amount"],
            ['name'=>"House up keeep",'slug'=>"house_up_keep",'account_number'=>'95212352451010','account_type'=>"office",'is_credit'=>0,"description"=>"This is Account store House up keep Amount"],
            ['name'=>"Medical exp For Local",'slug'=>"bomaid_local",'account_number'=>'95212352471001','account_type'=>"office",'is_credit'=>0,"description"=>"This is Account store Medical Expense of Local Amount"],
            ['name'=>"Medical exp For EXPATRIATE",'slug'=>"bomaid_ibo",'account_number'=>'95212352471003','account_type'=>"office",'is_credit'=>0,"description"=>"This is Account store Medical Expense of EXPATRIATE Amount"],
            ['name'=>"Bank's Conti to Pension",'slug'=>"banks_conti_to_pension",'account_number'=>'95212352461006','account_type'=>"office",'is_credit'=>0,"description"=>"This is Account store Bank's Conti to Pension Amount"],
            ['name'=>"Sundry Dep-Pension EFT ",'slug'=>"sundry_dep_pension_eft",'account_number'=>'95212313201004','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account store Sundry Dep-Pension{EFT}"],
            ['name'=>"B.B.E.U  {Banker Chq}",'slug'=>"B_B_E_U_Banker_Chq",'account_number'=>'95212315106004','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account store B.B.E.U  {Banker Chq}"],
            ['name'=>"EFT to FNB Bank",'slug'=>"eft_to_fnb_bank",'account_number'=>'95212322203001','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account store EFT to FNB Bank"],
            ['name'=>"Cont. PF",'slug'=>"pf_contribution",'account_number'=>'95212352461009','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account store Pf Contribution"],
            ['name'=>"Vehicle exp",'slug'=>"vehicle_expenses",'account_number'=>'95212354511016','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account store Pf Vehicle exp"],
            ['name'=>"Income tax",'slug'=>"income_tax",'account_number'=>'95212352451013','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account store of Income tax"],
        ];

        foreach($accounts as $key => $value)
        {
            Account::updateOrCreate(['slug'=>$value['slug']],$value);
        }

    }
}
