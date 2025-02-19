<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            //Mail mall & Head office - 9521
            ['name'=>"Salaries",'slug'=>"salaries",'account_number'=>'95212352401001','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Employee Basic Salary",'branch_id'=>1],
            ['name'=>"Entertainment",'slug'=>"entertainment",'account_number'=>'95212352401010','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Entertainment Amount",'branch_id'=>1],
            ['name'=>"Education",'slug'=>"education",'account_number'=>'95212352451009','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Education Amount",'branch_id'=>1],
            ['name'=>"House up keep",'slug'=>"house_up_keep",'account_number'=>'95212352451010','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  House up keep Amount",'branch_id'=>1],
            ['name'=>"Medical exp For Local",'slug'=>"bomaid_local",'account_number'=>'95212352471001','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Medical Expense of Local Amount",'branch_id'=>1],
            ['name'=>"Medical exp For EXPATRIATE",'slug'=>"bomaid_ibo",'account_number'=>'95212352471003','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Medical Expense of EXPATRIATE Amount",'branch_id'=>1],
            ['name'=>"PF Bank Contribution",'slug'=>"pf_bank_contribution",'account_number'=>'test','account_type'=>"office",'is_credit'=>0,"description"=>"This Account is for  Pf Contribution",'branch_id'=>1],
            ['name'=>"Bank's Conti to Pension",'slug'=>"banks_conti_to_pension",'account_number'=>'95212352461006','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account  is for Bank's Conti to Pension Amount",'branch_id'=>1],
            ['name'=>"Sundry Dep-Pension EFT ",'slug'=>"sundry_dep_pension_eft",'account_number'=>'95212313201004','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account is for  Sundry Dep-Pension{EFT}",'branch_id'=>1],
            ['name'=>"B.B.E.U  {Banker Chq}",'slug'=>"B_B_E_U_Banker_Chq",'account_number'=>'95212315106004','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account is for  B.B.E.U  {Banker Chq}",'branch_id'=>1],
            ['name'=>"EFT to FNB Bank",'slug'=>"eft_to_fnb_bank",'account_number'=>'95212322203001','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account  is for EFT to FNB Bank",'branch_id'=>1],
            ['name'=>"Cont. PF",'slug'=>"pf_contribution",'account_number'=>'95212352461009','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account  is for Pf Contribution",'branch_id'=>1],
            ['name'=>"Vehicle exp",'slug'=>"vehicle_expenses",'account_number'=>'95212354511016','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account is for  Vehicle exp",'branch_id'=>1],
            ['name'=>"Income tax",'slug'=>"income_tax",'account_number'=>'95212352451013','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account  of Income tax",'branch_id'=>1],
            ['name'=>"SPECIAL ADVANCE TO STAFF",'slug'=>"special_advance_to_staff",'account_number'=>'95212326681010','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account for SPECIAL ADVANCE TO STAFF",'branch_id'=>1],
            ['name'=>"TDS Staff",'slug'=>"tds_staff",'account_number'=>'95212352451013','account_type'=>"office",'is_credit'=>0,"description"=>"This is Account for TDS TO STAFF",'branch_id'=>1],
            ['name'=>"Inter Branch account Credit originating",'slug'=>"inter_branch_account",'account_number'=>'95212331106001','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account for Inter Branch account Credit originating",'branch_id'=>1],
        
            //Francistown-9522,
            ['name'=>"Salaries",'slug'=>"salaries",'account_number'=>'95222352401001','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Employee Basic Salary",'branch_id'=>2],
            ['name'=>"Entertainment",'slug'=>"entertainment",'account_number'=>'95222352401010','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Entertainment Amount",'branch_id'=>2],
            ['name'=>"Education",'slug'=>"education",'account_number'=>'95222352451009','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Education Amount",'branch_id'=>2],
            ['name'=>"House up keep",'slug'=>"house_up_keep",'account_number'=>'95222352451010','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  House up keep Amount",'branch_id'=>2],
            ['name'=>"Medical exp For Local",'slug'=>"bomaid_local",'account_number'=>'95222352471001','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Medical Expense of Local Amount",'branch_id'=>2],
            ['name'=>"Medical exp For EXPATRIATE",'slug'=>"bomaid_ibo",'account_number'=>'95222352471003','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Medical Expense of EXPATRIATE Amount",'branch_id'=>2],
            ['name'=>"PF Bank Contribution",'slug'=>"pf_bank_contribution",'account_number'=>'test','account_type'=>"office",'is_credit'=>0,"description"=>"This Account is for  Pf Contribution",'branch_id'=>2],
            ['name'=>"Bank's Conti to Pension",'slug'=>"banks_conti_to_pension",'account_number'=>'95222352461006','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account  is for Bank's Conti to Pension Amount",'branch_id'=>2],
            ['name'=>"Sundry Dep-Pension EFT ",'slug'=>"sundry_dep_pension_eft",'account_number'=>'95222313201004','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account is for  Sundry Dep-Pension{EFT}",'branch_id'=>2],
            ['name'=>"B.B.E.U  {Banker Chq}",'slug'=>"B_B_E_U_Banker_Chq",'account_number'=>'95222315106004','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account is for  B.B.E.U  {Banker Chq}",'branch_id'=>2],
            ['name'=>"EFT to FNB Bank",'slug'=>"eft_to_fnb_bank",'account_number'=>'95222322203001','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account  is for EFT to FNB Bank",'branch_id'=>2],
            ['name'=>"Cont. PF",'slug'=>"pf_contribution",'account_number'=>'95222352461009','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account  is for Pf Contribution",'branch_id'=>2],
            ['name'=>"Vehicle exp",'slug'=>"vehicle_expenses",'account_number'=>'95222354511016','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account is for  Vehicle exp",'branch_id'=>2],
            ['name'=>"Income tax",'slug'=>"income_tax",'account_number'=>'95222352451013','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account  of Income tax",'branch_id'=>2],
            ['name'=>"SPECIAL ADVANCE TO STAFF",'slug'=>"special_advance_to_staff",'account_number'=>'95222326681010','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account for SPECIAL ADVANCE TO STAFF",'branch_id'=>2],
            ['name'=>"TDS Staff",'slug'=>"tds_staff",'account_number'=>'95222352451013','account_type'=>"office",'is_credit'=>0,"description"=>"This is Account for TDS TO STAFF",'branch_id'=>2],
            ['name'=>"Inter Branch account Credit originating",'slug'=>"inter_branch_account",'account_number'=>'95222331106001','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account for Inter Branch account Credit originating",'branch_id'=>2],
        


            //Gwest-9523
            ['name'=>"Salaries",'slug'=>"salaries",'account_number'=>'95232352401001','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Employee Basic Salary",'branch_id'=>3],
            ['name'=>"Entertainment",'slug'=>"entertainment",'account_number'=>'95232352401010','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Entertainment Amount",'branch_id'=>3],
            ['name'=>"Education",'slug'=>"education",'account_number'=>'95232352451009','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Education Amount",'branch_id'=>3],
            ['name'=>"House up keep",'slug'=>"house_up_keep",'account_number'=>'95232352451010','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  House up keep Amount",'branch_id'=>3],
            ['name'=>"Medical exp For Local",'slug'=>"bomaid_local",'account_number'=>'95232352471001','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Medical Expense of Local Amount",'branch_id'=>3],
            ['name'=>"Medical exp For EXPATRIATE",'slug'=>"bomaid_ibo",'account_number'=>'95232352471003','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Medical Expense of EXPATRIATE Amount",'branch_id'=>3],
            ['name'=>"PF Bank Contribution",'slug'=>"pf_bank_contribution",'account_number'=>'test','account_type'=>"office",'is_credit'=>0,"description"=>"This Account is for  Pf Contribution",'branch_id'=>3],
            ['name'=>"Bank's Conti to Pension",'slug'=>"banks_conti_to_pension",'account_number'=>'95232352461006','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account  is for Bank's Conti to Pension Amount",'branch_id'=>3],
            ['name'=>"Sundry Dep-Pension EFT ",'slug'=>"sundry_dep_pension_eft",'account_number'=>'95232313201004','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account is for  Sundry Dep-Pension{EFT}",'branch_id'=>3],
            ['name'=>"B.B.E.U  {Banker Chq}",'slug'=>"B_B_E_U_Banker_Chq",'account_number'=>'95232315106004','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account is for  B.B.E.U  {Banker Chq}",'branch_id'=>3],
            ['name'=>"EFT to FNB Bank",'slug'=>"eft_to_fnb_bank",'account_number'=>'95232322203001','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account  is for EFT to FNB Bank",'branch_id'=>3],
            ['name'=>"Cont. PF",'slug'=>"pf_contribution",'account_number'=>'95232352461009','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account  is for Pf Contribution",'branch_id'=>3],
            ['name'=>"Vehicle exp",'slug'=>"vehicle_expenses",'account_number'=>'95232354511016','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account is for  Vehicle exp",'branch_id'=>3],
            ['name'=>"Income tax",'slug'=>"income_tax",'account_number'=>'95232352451013','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account  of Income tax",'branch_id'=>3],
            ['name'=>"SPECIAL ADVANCE TO STAFF",'slug'=>"special_advance_to_staff",'account_number'=>'95232326681010','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account for SPECIAL ADVANCE TO STAFF",'branch_id'=>3],
            ['name'=>"TDS Staff",'slug'=>"tds_staff",'account_number'=>'95232352451013','account_type'=>"office",'is_credit'=>0,"description"=>"This is Account for TDS TO STAFF",'branch_id'=>3],
            ['name'=>"Inter Branch account Credit originating",'slug'=>"inter_branch_account",'account_number'=>'95232331106001','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account for Inter Branch account Credit originating",'branch_id'=>3],
        
           
            // Palaype- 9524
            ['name'=>"Salaries",'slug'=>"salaries",'account_number'=>'95242352401001','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Employee Basic Salary",'branch_id'=>4],
            ['name'=>"Entertainment",'slug'=>"entertainment",'account_number'=>'95242352401010','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Entertainment Amount",'branch_id'=>4],
            ['name'=>"Education",'slug'=>"education",'account_number'=>'95242352451009','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Education Amount",'branch_id'=>4],
            ['name'=>"House up keep",'slug'=>"house_up_keep",'account_number'=>'95242352451010','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  House up keep Amount",'branch_id'=>4],
            ['name'=>"Medical exp For Local",'slug'=>"bomaid_local",'account_number'=>'95242352471001','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Medical Expense of Local Amount",'branch_id'=>4],
            ['name'=>"Medical exp For EXPATRIATE",'slug'=>"bomaid_ibo",'account_number'=>'95242352471003','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account is for  Medical Expense of EXPATRIATE Amount",'branch_id'=>4],
            ['name'=>"PF Bank Contribution",'slug'=>"pf_bank_contribution",'account_number'=>'test','account_type'=>"office",'is_credit'=>0,"description"=>"This Account is for  Pf Contribution",'branch_id'=>4],
            ['name'=>"Bank's Conti to Pension",'slug'=>"banks_conti_to_pension",'account_number'=>'95242352461006','account_type'=>"office",'is_credit'=>0,"description"=>"This  Account  is for Bank's Conti to Pension Amount",'branch_id'=>4],
            ['name'=>"Sundry Dep-Pension EFT ",'slug'=>"sundry_dep_pension_eft",'account_number'=>'95242313201004','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account is for  Sundry Dep-Pension{EFT}",'branch_id'=>4],
            ['name'=>"B.B.E.U  {Banker Chq}",'slug'=>"B_B_E_U_Banker_Chq",'account_number'=>'95242315106004','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account is for  B.B.E.U  {Banker Chq}",'branch_id'=>4],
            ['name'=>"EFT to FNB Bank",'slug'=>"eft_to_fnb_bank",'account_number'=>'95242322203001','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account  is for EFT to FNB Bank",'branch_id'=>4],
            ['name'=>"Cont. PF",'slug'=>"pf_contribution",'account_number'=>'95242352461009','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account  is for Pf Contribution",'branch_id'=>4],
            ['name'=>"Vehicle exp",'slug'=>"vehicle_expenses",'account_number'=>'95242354511016','account_type'=>"office",'is_credit'=>1,"description"=>"This  Account is for  Vehicle exp",'branch_id'=>4],
            ['name'=>"Income tax",'slug'=>"income_tax",'account_number'=>'95242352451013','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account  of Income tax",'branch_id'=>4],
            ['name'=>"SPECIAL ADVANCE TO STAFF",'slug'=>"special_advance_to_staff",'account_number'=>'95242326681010','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account for SPECIAL ADVANCE TO STAFF",'branch_id'=>4],
            ['name'=>"TDS Staff",'slug'=>"tds_staff",'account_number'=>'95242352451013','account_type'=>"office",'is_credit'=>0,"description"=>"This is Account for TDS TO STAFF",'branch_id'=>4],
            ['name'=>"Inter Branch account Credit originating",'slug'=>"inter_branch_account",'account_number'=>'95242331106001','account_type'=>"office",'is_credit'=>1,"description"=>"This is Account for Inter Branch account Credit originating",'branch_id'=>4],
        
        ];
        DB::table('accounts')->delete();
        foreach($accounts as $key => $value)
        {
            Account::updateOrCreate(['slug'=>$value['slug'],'branch_id'=>$value['branch_id']],$value);
        }

    }
}
