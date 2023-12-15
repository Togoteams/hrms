<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Brachseeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_branch = array(
            // for local all leaves
            ['name' => "Gaborone, Main Mall",'code'=>'9521','address'=>'none','city'=>'','state'=>'','country'=>'','landmark'=>'none','is_main_branch'=>1, 'description' => "none"],
            ['name' => "Francistown",'code'=>'9522','address'=>'none','city'=>'','state'=>'','country'=>'','landmark'=>'none','is_main_branch'=>0, 'description' => "none"],
            ['name' => "G-west",'code'=>'9523','address'=>'none','city'=>'','state'=>'','country'=>'','landmark'=>'none','is_main_branch'=>0, 'description' => "none"],
            ['name' => "Palapye",'code'=>'9524','address'=>'none','city'=>'','state'=>'','country'=>'','landmark'=>'none','is_main_branch'=>0, 'description' => "none"],

        );
        foreach ($all_branch as $d) {
            Branch::insert($d);
        }
    }
}
