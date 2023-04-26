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
            ['leave_for' => "local", 'name' => "EARNED LEAVE", 'description' => "none"],
            ['leave_for' => "local", 'name' => "SICK LEAVE", 'description' => "none"],
            ['leave_for' => "local", 'name' => "MATERNITY LEAVE", 'description' => "none"],
            ['leave_for' => "local", 'name' => "BEREAVEMENT LEAVE", 'description' => "none"],
            ['leave_for' => "local", 'name' => "LEAVE WITHOUT PAY", 'description' => "none"],
            // for expatriate all leaves
            ['leave_for' => "expatriate", 'name' => "CASUAL LEAVE", 'description' => "none"],
            ['leave_for' => "expatriate", 'name' => "MATERNITY LEAVE", 'description' => "none"],
            ['leave_for' => "expatriate", 'name' => "PRIVILEGED LEAVE", 'description' => "none"],
            ['leave_for' => "expatriate",  'name' => "LEAVE WITHOUT PAY", 'description' => "none"],
            ['leave_for' => "expatriate",  'name' => "LEAVE ENCASHMENT", 'description' => "none"],
            ['leave_for' => "expatriate", 'name' => "LEAVE ON REPATRIATION", 'description' => "none"],


        );
        DB::table('leave_types')->delete();
        foreach ($all_leaves as $leaves) {

            LeaveType::insert($leaves);
        }
    }
}
