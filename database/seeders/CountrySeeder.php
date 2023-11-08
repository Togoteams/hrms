<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //
         $countries = [
            ['name'=>"Botswana",'std_code'=>'+267'],
            ['name'=>"India",'std_code'=>'+91'],
        ];
        foreach($countries as $key => $value)
        {

            Country::updateOrCreate(['name'=>$value['name']],$value);
        }
    }
}
