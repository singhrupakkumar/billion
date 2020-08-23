<?php

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
  // User seeder will use the roles above created.
      $this->call([
        UsersTableSeeder::class,
        RoleTableSeeder::class,
     ]);
       
      
    } 
}
