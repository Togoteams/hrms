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
            [ 'name' => 'SICK LEAVE','slug'=>'sick-leave','emp_type'=>1,'total_leave_year'=>20,'max_leave_at_time'=>0,'is_accumulated'=>0,'is_accumulated_max_value'=>0,'extended_leaves_year'=>0,'is_salary_deduction'=>0,'salary_deduction_per'=>0,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 0, 'starting_date'=>0, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>1,'expiry_date_message'=>'20 days will be credited after completion of one year from date of joining or preious year credit and will expired if not utilized with in one year'],
            [ 'name' => 'EARNED LEAVE','slug'=>'earned-leave','emp_type'=>1,'total_leave_year'=>18,'max_leave_at_time'=>0,'is_accumulated'=>1,'is_accumulated_max_value'=>54, 'extended_leaves_year'=>0,'is_salary_deduction'=>0,'salary_deduction_per'=>0,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>0,'expiry_date_message'=>'1.50 days leave in a month and  total 18 leaves in a year and balance will carry forward to another year untill 3 years'],
            [ 'name' => 'BEREAVEMENT LEAVE','slug'=>'bereavement-leave','emp_type'=>1,'total_leave_year'=>0,'max_leave_at_time'=>3,'is_accumulated'=>1,'is_accumulated_max_value'=>0, 'extended_leaves_year'=>0,'is_salary_deduction'=>0,'salary_deduction_per'=>0,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>0,'expiry_date_message'=>'Total 3 days as and when required in case of close family (mother/father/brother/sister/wife / husband/ children)menber and 1 day for extended family (uncle/aunty/Grand father/ Grand mother/ Cousin'],
            [ 'name' => 'LEAVE WITHOUT PAY','slug'=>'leave-without-pay','emp_type'=>1,'total_leave_year'=>0,'max_leave_at_time'=>0,'is_accumulated'=>1,'is_accumulated_max_value'=>0, 'extended_leaves_year'=>0,'is_salary_deduction'=>1,'salary_deduction_per'=>100,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>1,'is_leave_encash'=>0,'is_certificate'=>0,'expiry_date_message'=>''],
            [ 'name' => 'MATERNITY LEAVE','slug'=>'maternity-leave','emp_type'=>1,'total_leave_year'=>84,'max_leave_at_time'=>0,'is_accumulated'=>1,'is_accumulated_max_value'=>0, 'extended_leaves_year'=>14,'is_salary_deduction'=>1,'salary_deduction_per'=>50,'extended_leaves_deduction_per'=>75,  'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>1,'expiry_date_message'=>''],

             // for Ibo all leaves
             [ 'name' => 'SICK LEAVE','slug'=>'sick-leave','emp_type'=>0,'total_leave_year'=>15,'max_leave_at_time'=>0,'is_accumulated'=>1,'is_accumulated_max_value'=>0,'extended_leaves_year'=>0,'is_salary_deduction'=>0,'salary_deduction_per'=>0,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>1,'is_leave_encash'=>0,'is_certificate'=>1,'expiry_date_message'=>''],
             [ 'name' => 'MATERNITY LEAVE','slug'=>'maternity-leave','emp_type'=>0,'total_leave_year'=>84,'max_leave_at_time'=>0,'is_accumulated'=>0,'is_accumulated_max_value'=>0,'extended_leaves_year'=>14,'is_salary_deduction'=>1,'salary_deduction_per'=>50,'extended_leaves_deduction_per'=>75, 'is_pro_data' => 0, 'starting_date'=>0, 'is_count_holyday'=>1,'is_leave_encash'=>0,'is_certificate'=>1,'expiry_date_message'=>''],
             [ 'name' => 'LEAVE WITHOUT PAY','slug'=>'leave-without-pay','emp_type'=>0,'total_leave_year'=>0,'max_leave_at_time'=>0,'is_accumulated'=>0,'is_accumulated_max_value'=>0,'extended_leaves_year'=>0,'is_salary_deduction'=>1,'salary_deduction_per'=>100,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 0, 'starting_date'=>0, 'is_count_holyday'=>1,'is_leave_encash'=>0,'is_certificate'=>0,'expiry_date_message'=>''],
             [ 'name' => 'CASUAL LEAVE','slug'=>'casual-leave','emp_type'=>0,'total_leave_year'=>12,'max_leave_at_time'=>4,'is_accumulated'=>0,'is_accumulated_max_value'=>0,'extended_leaves_year'=>0,'is_salary_deduction'=>0,'salary_deduction_per'=>0,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 1, 'starting_date'=>0, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>0,'expiry_date_message'=>''],
             [ 'name' => 'PRIVILEGED LEAVE','slug'=>'privileged-leave','emp_type'=>0,'total_leave_year'=>30,'max_leave_at_time'=>0,'is_accumulated'=>1,'is_accumulated_max_value'=>0,'extended_leaves_year'=>0,'is_salary_deduction'=>0,'salary_deduction_per'=>0,'extended_leaves_deduction_per'=>0, 'is_pro_data' => 1, 'starting_date'=>1, 'is_count_holyday'=>1,'is_leave_encash'=>1,'is_certificate'=>0,'expiry_date_message'=>''],

        
        );
        foreach ($all_taxes as $all) {
            LeaveSetting::updateOrCreate(["slug"=>$all['slug'],'emp_type'=>$all['emp_type']],$all);
        }
    }
}
