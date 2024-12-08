<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\ReimbursementType;
use Illuminate\Support\Facades\DB;

class ReimbursementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reimbursementType = [
            ['type'=>"Water Charges",'slug'=>"water_charges","is_tax_exempt"=>1],
            ['type'=>"Reimbursement Telephone Expenses paid at Residence",'slug'=>"telephone_expenses","is_tax_exempt"=>1],
            ['type'=>"Electricity Charges",'slug'=>"electricity_charges","is_tax_exempt"=>0],
            ['type'=>"Diem Allowance",'slug'=>"diem_allowance","is_tax_exempt"=>0],
            ['type'=>"Travelling Expenses",'slug'=>"travelling_expenses","is_tax_exempt"=>0],
            ['type'=>"Transport Expenses",'slug'=>"transport_expenses","is_tax_exempt"=>1],
            ['type'=>"Housing Benefit",'slug'=>"housing_benefit","is_tax_exempt"=>0],
            ['type'=>"Car Benefit",'slug'=>"car_benefit","is_tax_exempt"=>0],
            ['type'=>"Furniture Benefit",'slug'=>"furniture_benefit","is_tax_exempt"=>0],
            ['type'=>"Reimbursement of Mobile/ Internet Charges/ landline",'slug'=>"mobile_internet_charges_landline","is_tax_exempt"=>1],
            ];
        DB::table('reimbursement_types')->delete();
        foreach($reimbursementType as $key => $value)
        {
            ReimbursementType::updateOrCreate(['slug'=>$value['slug']],$value);
        }

    }
}
