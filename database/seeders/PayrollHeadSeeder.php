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
            ['name' => 'hra', 'slug' => 'hra', 'placeholder' => 'hra', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'overtime', 'slug' => 'overtime', 'placeholder' => 'overtime', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'arrear', 'slug' => 'arrear', 'placeholder' => 'arrear', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'union_membership', 'slug' => 'union_membership', 'placeholder' => 'union_membership', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'pf_per', 'slug' => 'pf_per', 'placeholder' => 'pf_per', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'pf_amount', 'slug' => 'pf_amount', 'placeholder' => 'pf_amount', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'pension_per', 'slug' => 'pension_per', 'placeholder' => 'pension_per', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'pension_amount', 'slug' => 'pension_amount', 'placeholder' => 'pension_amount', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'loans_deduction', 'slug' => 'loans_deduction', 'placeholder' => 'loans_deduction', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'no_of_working_days', 'slug' => 'no_of_working_days', 'placeholder' => 'no_of_working_days', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'no_of_paid_leaves', 'slug' => 'no_of_paid_leaves', 'placeholder' => 'no_of_paid_leaves', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'shift', 'slug' => 'shift', 'placeholder' => 'shift', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'no_of_payable_days', 'slug' => 'no_of_payable_days', 'placeholder' => 'no_of_payable_days', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'conveyance', 'slug' => 'conveyance', 'placeholder' => 'conveyance', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'special', 'slug' => 'special', 'placeholder' => 'special', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'mobile', 'slug' => 'mobile', 'placeholder' => 'mobile', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'bonus', 'slug' => 'bonus', 'placeholder' => 'bonus', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'transportation', 'slug' => 'transportation', 'placeholder' => 'transportation', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'food', 'slug' => 'food', 'placeholder' => 'food', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'medical', 'slug' => 'medical', 'placeholder' => 'medical', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'esi_per', 'slug' => 'esi_per', 'placeholder' => 'esi_per', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'esi_amount', 'slug' => 'esi_amount', 'placeholder' => 'esi_amount', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'income_tax_deductions', 'slug' => 'income_tax_deductions', 'placeholder' => 'income_tax_deductions', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
            ['name' => 'penalty_deductions', 'slug' => 'penalty_deductions', 'placeholder' => 'penalty_deductions', 'employment_type' => 'both', 'for' => 'payscale', 'is_dropdown' => 'no', 'created_by' => 1,],
          
        );
        foreach ($all_member as $am) {
            PayrollHead::insert($am);
        }

    }
}
