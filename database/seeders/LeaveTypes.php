<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $all_leaves = array(
            // for local all leaves
            ['leave_for' => "local", 'name' => "EARNED LEAVE", 'description' => "none", "nature_of_leave" => "paid", "no_of_days" => 0, "created_by" => 1],
            ['leave_for' => "local", 'name' => "SICK LEAVE", 'description' => "none",  "nature_of_leave" => "unpaid", "no_of_days" => 20, "created_by" => 1],
            ['leave_for' => "local", 'name' => "MATERNITY LEAVE", 'description' => "none",  "nature_of_leave" => "paid", "no_of_days" => 0, "created_by" => 1],
            ['leave_for' => "local", 'name' => "BEREAVEMENT LEAVE", 'description' => "none",  "nature_of_leave" => "paid", "no_of_days" => 0, "created_by" => 1],
            ['leave_for' => "local", 'name' => "LEAVE WITHOUT PAY", 'description' => "none",  "nature_of_leave" => "paid", "no_of_days" => 0, "created_by" => 1],
            // for expatriate all leaves
            ['leave_for' => "expatriate", 'name' => "CASUAL LEAVE", 'description' => "none",  "nature_of_leave" => "unpaid", "no_of_days" => 20, "created_by" => 1],
            ['leave_for' => "expatriate", 'name' => "MATERNITY LEAVE", 'description' => "none",  "nature_of_leave" => "paid", "no_of_days" => 0, "created_by" => 1],
            ['leave_for' => "expatriate", 'name' => "PRIVILEGED LEAVE", 'description' => "none",  "nature_of_leave" => "paid", "no_of_days" => 0, "created_by" => 1],
            ['leave_for' => "expatriate",  'name' => "LEAVE WITHOUT PAY", 'description' => "none",  "nature_of_leave" => "paid", "no_of_days" => 0, "created_by" => 1],
            ['leave_for' => "expatriate",  'name' => "LEAVE ENCASHMENT", 'description' => "none",  "nature_of_leave" => "paid", "no_of_days" => 0, "created_by" => 1],
            ['leave_for' => "expatriate", 'name' => "LEAVE ON REPATRIATION", 'description' => "none",  "nature_of_leave" => "paid", "no_of_days" => 0, "created_by" => 1],


        );
        DB::table('leave_types')->delete();
        foreach ($all_leaves as $leaves) {

            LeaveType::insert($leaves);
        }
    }
}
