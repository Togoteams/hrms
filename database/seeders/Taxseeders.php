<?php

namespace Database\Seeders;

use App\Models\Tax;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Taxseeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $all_taxes = array(
            // for local all leaves
            [ 'name' => "Profesional tax",'type'=>'percentage','value'=>200,'created_by'=>1, 'description' => "none"],
            [ 'name' => "Gst tax",'type'=>'flat','value'=>2000,'created_by'=>1, 'description' => "none"],
            [ 'name' => "Pf Tax",'type'=>'percentage','value'=>200,'created_by'=>1, 'description' => "none"],
            [ 'name' => "Esi Tax",'type'=>'percentage','value'=>200,'created_by'=>1, 'description' => "none"],
        
        );
        foreach ($all_taxes as $all) {
            Tax::insert($all);
        }
    }
}
