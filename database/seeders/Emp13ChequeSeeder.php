<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Emp13thCheque;
class Emp13ChequeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $check1 = Emp13thCheque::updateOrCreate(['user_id'=>2],['user_id'=>2,'amount'=>'3500','cheques_month_year'=>"2023-12",'status'=>'active']);
    }
}
