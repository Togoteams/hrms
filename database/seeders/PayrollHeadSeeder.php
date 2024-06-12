<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PayrollHead;
use DB;
class PayrollHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allPayrollHeads = array(
            // for local all leaves
            ['name' => 'BoMaid', 'slug' => 'bomaid_bank', 'placeholder' => 'Bomaid Bank Contributtion', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1],
            ['name' => 'BoMaid Fund', 'slug' => 'bomaid', 'placeholder' => 'BoMaid', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1],
            ['name' => 'Pension Fund', 'slug' => 'pension_own', 'placeholder' => 'Pension Own contribution', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1],
            ['name' => 'Pension', 'slug' => 'pension_bank', 'placeholder' => 'Pension Bank Contributtion', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1],
            ['name' => 'Union Fee', 'slug' => 'union_fee', 'placeholder' => 'Union Fee', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1],
            ['name' => 'Other Deductions', 'slug' => 'other_deductions', 'placeholder' => 'Other deductions', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1],
            ['name' => 'Tax', 'slug' => 'tax', 'placeholder' => 'Tax', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1],
            ['name' => 'Allowance', 'slug' => 'allowance', 'placeholder' => 'Allowance', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1],
            // ['name' => 'Loan', 'slug' => 'loan', 'placeholder' => 'Loan', 'employment_type' => 'expatriate', 'for' => 'salary', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1],
            ['name' => 'Personal Loan', 'slug' => 'personal_loan', 'placeholder' => 'Personal Loan', 'employment_type' => 'both', 'for' => 'salary', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1],
            ['name' => 'Car Loan', 'slug' => 'car_loan', 'placeholder' => 'Car Loan', 'employment_type' => 'both', 'for' => 'salary', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1],
            ['name' => 'Mortgage Loan', 'slug' => 'mortgage_loan', 'placeholder' => 'Mortgage Loan', 'employment_type' => 'both', 'for' => 'salary', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1],
            ['name' => 'Salary advance', 'slug' => 'salary_advance', 'placeholder' => 'Salary advance', 'employment_type' => 'both', 'for' => 'salary', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1],
            ['name' => 'Others/Arrears', 'slug' => 'others_arrears', 'placeholder' => 'Others/Arrears', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income",'created_by' => 1],
            ['name' => 'Over Time', 'slug' => 'over_time', 'placeholder' => 'Over Time', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1],
            ['name' => 'Reimbursement', 'slug' => 'reimbursement', 'placeholder' => 'Reimbursement', 'employment_type' => 'expatriate', 'for' => 'salary', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1],
            ['name' => 'Entertainment Expenses', 'slug' => 'entertainment_expenses', 'placeholder' => 'Entertainment Expenses', 'employment_type' => 'expatriate', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1],
            ['name' => 'House Up Keep Allow', 'slug' => 'house_up_keep_allow', 'placeholder' => 'House Up Keep Allow', 'employment_type' => 'expatriate', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1],
            ['name' => 'Provident Fund', 'slug' => 'provident_fund', 'placeholder' => 'Provident Fund', 'employment_type' => 'expatriate', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1],
            ['name' => 'Education Allowance For IND', 'slug' => 'education_allowance', 'placeholder' => 'Education Allowance', 'employment_type' => 'expatriate', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1],
            ['name' => 'Recovery for Car', 'slug' => 'recovery_for_car', 'placeholder' => 'Recovery for Car', 'employment_type' => 'expatriate', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1],

        );
        $head = \DB::table('payroll_heads')->delete();
        foreach ($allPayrollHeads as $am) {
            PayrollHead::updateOrCreate(['slug'=>$am['slug']],$am);
        }

    }
}
