<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\ReimbursementType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReimbursementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reimbursementType = [
            ['type'=>"Water Charges",'slug'=>"water_charges",'account_no'=>"95222352501006","is_tax_exempt"=>1],
            ['type'=>"Electricity Charges",'slug'=>"electricity_charges",'account_no'=>"95222352501009","is_tax_exempt"=>0],
            ['type'=>"EDUCATIONAL Expenses",'slug'=>"educational_charges",'account_no'=>"35222352451009","is_tax_exempt"=>0],
            ['type'=>"Diem Allowance",'slug'=>"diem_allowance",'account_no'=>"95222354561004","is_tax_exempt"=>0],
            ['type'=>"Travelling Expenses",'slug'=>"travelling_expenses",'account_no'=>"95222354561004","is_tax_exempt"=>0],
            ['type'=>"Car Benefit",'slug'=>"car_benefit",'account_no'=>"95222354511016","is_tax_exempt"=>0],
            ['type'=>"TELEPHONES RESIDENCE",'account_no'=>"95222354201008",'slug'=>"mobile_internet_charges_landline","is_tax_exempt"=>1],
            ];
        DB::table('reimbursement_types')->delete();
        foreach($reimbursementType as $key => $value)
        {
            ReimbursementType::updateOrCreate(['slug'=>$value['slug']],$value);
            $accountData = ['account_number'=>$value['account_no'],"account_type"=>"reimbursement",'name'=>Str::title(str_replace('-', ' ',$value['type'])),'slug'=>Str::slug($value['type'],"_"),'is_credit'=>0,'description'=>ucfirst($value['type'])." for Reimbursement"];
            $account = Account::updateOrCreate(['account_number'=>$value['account_no']],$accountData);
        }

    }
}
