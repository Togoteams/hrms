<?php

namespace Database\Seeders;

use App\Models\Designation;
use App\Models\Membership;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionTableSeeder::class,
            // UserTableSeeder::class,
            RolesTableSeeder::class,
            // LeaveTypes::class,
            RolePermissionSeeder::class,
            Designationseeders::class,
            Brachseeders::class,
            TaxSlabSeeder::class,
            Membershipseeders::class,
            CurrencySeetingSeeder::class,
            Employeeseeders::class,
            PayrollHeadSeeder::class,
            DepartmentSeeder::class,
            LeaveSettingSeeder::class,
            CountrySeeder::class,
            AccountTableSeeder::class,
        ]);
    }
}
