<?php

namespace Database\Seeders;

use App\Models\LeaveSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_taxes = array(
            // for local all leaves
            [ 'name' => 'SICK LEAVE','slug'=>'sick-leave','emp_type'=>1,'total_leave_year'=>20,'max_leave_at_time'=>0,'is_accumulated'=>0,'is_accumulated_max_value'=>0,'extended_leaves_year'=>0,'is_salary_deduction'=>0,'salary_deduction_per'=>0,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 0, 'starting_date'=>0, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>1],
            [ 'name' => 'EARNED LEAVE','slug'=>'earned-leave','emp_type'=>1,'total_leave_year'=>18,'max_leave_at_time'=>0,'is_accumulated'=>1,'is_accumulated_max_value'=>54, 'extended_leaves_year'=>0,'is_salary_deduction'=>0,'salary_deduction_per'=>0,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>0],
            [ 'name' => 'MATERNITY LEAVE','slug'=>'maternity-leave','emp_type'=>1,'total_leave_year'=>84,'max_leave_at_time'=>0,'is_accumulated'=>1,'is_accumulated_max_value'=>0, 'extended_leaves_year'=>14,'is_salary_deduction'=>1,'salary_deduction_per'=>50,'extended_leaves_deduction_per'=>75,  'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>1],
            [ 'name' => 'BEREAVEMENT LEAVE','slug'=>'bereavement-leave','emp_type'=>1,'total_leave_year'=>0,'max_leave_at_time'=>3,'is_accumulated'=>1,'is_accumulated_max_value'=>0, 'extended_leaves_year'=>0,'is_salary_deduction'=>0,'salary_deduction_per'=>0,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>0],
            [ 'name' => 'LEAVE WITHOUT PAY','slug'=>'leave-without-pay','emp_type'=>1,'total_leave_year'=>0,'max_leave_at_time'=>0,'is_accumulated'=>1,'is_accumulated_max_value'=>0, 'extended_leaves_year'=>0,'is_salary_deduction'=>1,'salary_deduction_per'=>100,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>1,'is_leave_encash'=>0,'is_certificate'=>0],

             // for Ibo all leaves
             [ 'name' => 'SICK LEAVE','slug'=>'sick-leave','emp_type'=>0,'total_leave_year'=>15,'max_leave_at_time'=>0,'is_accumulated'=>1,'is_accumulated_max_value'=>0,'extended_leaves_year'=>0,'is_salary_deduction'=>0,'salary_deduction_per'=>0,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>1,'is_leave_encash'=>0,'is_certificate'=>1],
             [ 'name' => 'MATERNITY LEAVE','slug'=>'maternity-leave','emp_type'=>0,'total_leave_year'=>84,'max_leave_at_time'=>0,'is_accumulated'=>0,'is_accumulated_max_value'=>0,'extended_leaves_year'=>14,'is_salary_deduction'=>1,'salary_deduction_per'=>50,'extended_leaves_deduction_per'=>75, 'is_pro_data' => 0, 'starting_date'=>0, 'is_count_holyday'=>1,'is_leave_encash'=>0,'is_certificate'=>1],
             [ 'name' => 'LEAVE WITHOUT PAY','slug'=>'leave-without-pay','emp_type'=>0,'total_leave_year'=>0,'max_leave_at_time'=>0,'is_accumulated'=>0,'is_accumulated_max_value'=>0,'extended_leaves_year'=>0,'is_salary_deduction'=>0,'salary_deduction_per'=>0,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 0, 'starting_date'=>0, 'is_count_holyday'=>1,'is_leave_encash'=>0,'is_certificate'=>0],
             [ 'name' => 'CASUAL LEAVE','slug'=>'casual-leave','emp_type'=>0,'total_leave_year'=>12,'max_leave_at_time'=>4,'is_accumulated'=>0,'is_accumulated_max_value'=>0,'extended_leaves_year'=>0,'is_salary_deduction'=>0,'salary_deduction_per'=>0,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 1, 'starting_date'=>0, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>0],
             [ 'name' => 'PRIVILEGED LEAVE','slug'=>'privileged-leave','emp_type'=>0,'total_leave_year'=>30,'max_leave_at_time'=>0,'is_accumulated'=>1,'is_accumulated_max_value'=>0,'extended_leaves_year'=>0,'is_salary_deduction'=>0,'salary_deduction_per'=>0,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 1, 'starting_date'=>1, 'is_count_holyday'=>1,'is_leave_encash'=>1,'is_certificate'=>0],

        
        );
        foreach ($all_taxes as $all) {
            LeaveSetting::updateOrCreate(["slug"=>$all['slug'],'emp_type'=>$all['emp_type']],$all);
        }
    }
}
