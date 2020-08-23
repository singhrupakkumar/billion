<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $role_customer = Role::where('name', 'customer')->first();
        $role_superadmin  = Role::where('name', 'superadmin')->first();
       
        $superadmin = new User();
        $superadmin->name = 'Atdoorstep Admin';
        $superadmin->email = 'rupak.dev@atdoorstep.ae';
        $superadmin->phone = '8865867272';
        $superadmin->password = bcrypt('atdoorstep'); 
        $superadmin->save();
        $superadmin->roles()->attach($role_superadmin);
        
        
        $customer = new User();
        $customer->name = 'Atdoorstep Customer';
        $customer->email = 'honey.dev@atdoorstep.ae';
        $superadmin->phone = '8865867271';
        $customer->password = bcrypt('atdoorstep');
        $customer->save();
        $customer->roles()->attach($role_customer);
    }
}
