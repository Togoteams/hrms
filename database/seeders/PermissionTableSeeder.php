<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json  = file_get_contents(database_path() . '/data/permission.json');
        $data  = json_decode($json);
        DB::table('permissions')->delete();

        foreach ($data->permissions as $key => $value) {
            Permission::updateOrCreate([
                'name'=> $value->name,
                'module'=> $value->module,
                'permissions_for' => json_encode(explode(",",$value->permissions_for))
            ]);
        }
    }
}
