<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SalarySetting;
class SalarySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SalarySetting::updateOrCreate(['bank_pension_contribution'=>15,'local_bank_bomaid_contribution'=>50,'ibo_bank_bomaid_contribution'=>100],['bank_pension_contribution'=>15,'local_bank_bomaid_contribution'=>50,'ibo_bank_bomaid_contribution'=>100,'salary_date'=>20]);
    }
}
