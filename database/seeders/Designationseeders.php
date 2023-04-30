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
            [ 'name' => "Managing Director", 'description' => "none"],
            [ 'name' => "Assistant General Manager", 'description' => "none"],
            [ 'name' => "Chief Manager", 'description' => "none"],
            [ 'name' => "Manager", 'description' => "none"],
            [ 'name' => "Assistant Manager", 'description' => "none"],
            [ 'name' => "Supervisor", 'description' => "none"],
            [ 'name' => "Teller", 'description' => "none"],
            [ 'name' => "Clerk/Assistant", 'description' => "none"],
            [ 'name' => "Tea Lady", 'description' => "none"],
            [ 'name' => "Messenger/Driver", 'description' => "none"],
            [ 'name' => "SHE Staff", 'description' => "none"],
        );
        foreach ($all_desgination as $d) {
            Designation::insert($d);
        }

    }
}
