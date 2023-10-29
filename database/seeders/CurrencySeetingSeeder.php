<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CurrencySetting;
class CurrencySeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $currency = [
            ['currency_name_from'=>"PULA",'currency_name_to'=>'USD','currency_amount_from'=>"1",'currency_amount_to'=>"0.073"],
            ['currency_name_from'=>"USD",'currency_name_to'=>'PULLA','currency_amount_from'=>"1",'currency_amount_to'=>"13.73"],
        ];
        foreach($currency as $key => $value)
        {
            
            CurrencySetting::updateOrCreate(['currency_name_from'=>$value['currency_name_from']],$value);
        }
    }
}
