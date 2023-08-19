<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_desgination = array(
            // for local all leaves
            ['name' => 'HR','slug' => "hr"],
            ['name' => 'Finance','slug' => "finance"],
            ['name' => 'Marketing','slug' => "marketing"],
            ['name' => 'IT','slug' => "it"],
            ['name' => 'credit','slug' => "credit"],

        );
        foreach ($all_desgination as $d) {
            Department::insert($d);
        }
    }
}
