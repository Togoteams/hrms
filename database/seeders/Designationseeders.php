<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Designationseeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_desgination = array(
            // for local all leaves
            [ 'name' => "Managing Director",'slug'=>"managing_director",'description' => "none"],
            [ 'name' => "Chief Manager",'slug'=>"chief_manager", 'description' => "none"],
            [ 'name' => "Senior Manager",'slug'=>"senior_manager", 'description' => "none"],
            [ 'name' => "General Manager",'slug'=>"general_manager", 'description' => "none"],
            [ 'name' => "Assistant General Manager",'slug'=>"assistant_general_manager", 'description' => "none"],
            [ 'name' => "Manager",'slug'=>"manager", 'description' => "none"],
            [ 'name' => "Assistant Manager",'slug'=>"assistant_manager", 'description' => "none"],
            [ 'name' => "Supervisor",'slug'=>"supervisor", 'description' => "none"],
            [ 'name' => "Teller",'slug'=>"teller", 'description' => "none"],
            [ 'name' => "Clerk/Assistant",'slug'=>"clerk_assistant", 'description' => "none"],
            [ 'name' => "Tea Lady",'slug'=>"tea_lady", 'description' => "none"],
            [ 'name' => "Messenger/Driver",'slug'=>"messenger_driver", 'description' => "none"],
            [ 'name' => "SHE Staff",'slug'=>"she_staff", 'description' => "none"],
        );
        foreach ($all_desgination as $d) {
            Designation::updateOrCreate(['slug'=>$d['slug']],$d);
        }

    }
}
