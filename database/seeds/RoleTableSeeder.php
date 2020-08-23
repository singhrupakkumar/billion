<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_superadmin = new Role();
        $role_superadmin->name = 'superadmin';
        $role_superadmin->description = 'A Super Admin User';
        $role_superadmin->save();

        $role_customer = new Role();
        $role_customer->name = 'customer';
        $role_customer->description = 'A Customer User';
        $role_customer->save(); 
    }
}
