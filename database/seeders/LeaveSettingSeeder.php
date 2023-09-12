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
            [ 'name' => 'SICK LEAVE','slug'=>'sick_leave','emp_type'=>1,'total_leave_year'=>20,'max_leave_at_time'=>0,'is_accumulated'=>0,'is_accumulated_max_value'=>0, 'is_pro_data' => 0, 'starting_date'=>0, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>1],
            [ 'name' => 'EARNED LEAVE','slug'=>'earned_leave','emp_type'=>1,'total_leave_year'=>18,'max_leave_at_time'=>0,'is_accumulated'=>1,'is_accumulated_max_value'=>0, 'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>0],
            [ 'name' => 'MATERNITY LEAVE','slug'=>'maternity_leave','emp_type'=>1,'total_leave_year'=>98,'max_leave_at_time'=>0,'is_accumulated'=>1,'is_accumulated_max_value'=>0, 'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>1],
            [ 'name' => 'BEREAVEMENT LEAVE','slug'=>'bereavement_leave','emp_type'=>1,'total_leave_year'=>0,'max_leave_at_time'=>3,'is_accumulated'=>1,'is_accumulated_max_value'=>0, 'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>0,'is_leave_encash'=>0,'is_certificate'=>0],
            [ 'name' => 'LEAVE WITHOUT PAY','slug'=>'leave_without_pay','emp_type'=>1,'total_leave_year'=>0,'max_leave_at_time'=>0,'is_accumulated'=>1,'is_accumulated_max_value'=>0, 'is_pro_data' => 0, 'starting_date'=>1, 'is_count_holyday'=>1,'is_leave_encash'=>0,'is_certificate'=>0]

        
        );
        foreach ($all_taxes as $all) {
            LeaveSetting::insert($all);
        }
    }
}
