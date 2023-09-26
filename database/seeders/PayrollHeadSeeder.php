<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PayrollHead;

class PayrollHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_member = array(
            // for local all leaves
            ['name' => 'BoMaid', 'slug' => 'bomaid', 'placeholder' => 'BoMaid', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1,],
            ['name' => 'Pension', 'slug' => 'pension', 'placeholder' => 'Pension', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1,],
            ['name' => 'Union Fee', 'slug' => 'union_fee', 'placeholder' => 'Union Fee', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1,],
            ['name' => 'Other Deductions', 'slug' => 'other_deductions', 'placeholder' => 'Other deductions', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1,],
            ['name' => 'Tax', 'slug' => 'tax', 'placeholder' => 'Tax', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1,],
            ['name' => 'Allowance', 'slug' => 'allowance', 'placeholder' => 'Allowance', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1,],
            ['name' => 'Others/Arrears', 'slug' => 'others_arrears', 'placeholder' => 'Others/Arrears', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1,],
            ['name' => 'Over Time', 'slug' => 'over_time', 'placeholder' => 'Over Time', 'employment_type' => 'local', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1,],
            ['name' => 'Entertainment Expenses', 'slug' => 'entertainment_expenses', 'placeholder' => 'Entertainment Expenses', 'employment_type' => 'expatriate', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1,],
            ['name' => 'House Up Keep Allow', 'slug' => 'house_up_keep_allow', 'placeholder' => 'House Up Keep Allow', 'employment_type' => 'expatriate', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1,],
            ['name' => 'Provident Fund', 'slug' => 'provident_fund', 'placeholder' => 'Provident Fund', 'employment_type' => 'expatriate', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"deduction", 'created_by' => 1,],
            ['name' => 'Education Allowance', 'slug' => 'education_allowance', 'placeholder' => 'Education Allowance', 'employment_type' => 'expatriate', 'for' => 'payscale', 'is_dropdown' => 'no','head_type'=>"income", 'created_by' => 1,],
        );
        foreach ($all_member as $am) {
            PayrollHead::insert($am);
        }

    }
}
