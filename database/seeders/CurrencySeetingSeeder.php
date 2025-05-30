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
            ['currency_name_from'=>"usd",'currency_name_to'=>'pula','currency_amount_from'=>"1",'currency_amount_to'=>"13.73"],
            ['currency_name_from'=>"usd",'currency_name_to'=>'inr','currency_amount_from'=>"1",'currency_amount_to'=>"83.01"],
            ['currency_name_from'=>"pula",'currency_name_to'=>'inr','currency_amount_from'=>"1",'currency_amount_to'=>"6.19"],
        ];
        foreach($currency as $key => $value)
        {
            CurrencySetting::updateOrCreate(['currency_name_from'=>$value['currency_name_from'],'currency_name_to'=>$value['currency_name_to']],$value);
        }
    }
}
