<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaxSlabSetting;
class TaxSlabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_taxes = array(
            // for local all leaves
            [ 'from' => 0,'to'=>'48000','local_tax_per'=>0,'ibo_tax_per'=>5,'additional_ibo_amount'=>0,'additional_local_amount'=>0, 'description' => "none"],
            [ 'from' => 48001,'to'=>'84000','local_tax_per'=>5,'ibo_tax_per'=>5,'additional_ibo_amount'=>0,'additional_local_amount'=>0, 'description' => "none"],
            [ 'from' => 84001,'to'=>'120000','local_tax_per'=>12.50,'ibo_tax_per'=>12.50,'additional_ibo_amount'=>4200,'additional_local_amount'=>1800, 'description' => "none"],
            [ 'from' => 120000,'to'=>'156000','local_tax_per'=>18.75,'ibo_tax_per'=>18.75,'additional_ibo_amount'=>8700,'additional_local_amount'=>6300, 'description' => "none"],
            [ 'from' => 156000,'to'=>'15600000','local_tax_per'=>25,'ibo_tax_per'=>25,'additional_ibo_amount'=>15450,'additional_local_amount'=>13050, 'description' => "none"]
        
        );
        foreach ($all_taxes as $all) {
            TaxSlabSetting::insert($all);
        }
    }
}
