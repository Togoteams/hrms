<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Membershipseeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_member = array(
            // for local all leaves
            ['name' => "test", 'amount' => '300', 'type' => 'all', 'membership_code' => '002', 'description' => "none"],
            ['name' => "tes1", 'amount' => '500', 'type' => 'all', 'membership_code' => '002', 'description' => "none"],
            ['name' => "tes2", 'amount' => '600', 'type' => 'all', 'membership_code' => '002', 'description' => "none"],
            ['name' => "tes3", 'amount' => '300', 'type' => 'all', 'membership_code' => '002', 'description' => "none"],
        );
        foreach ($all_member as $am) {
            Membership::insert($am);
        }
    }
}
