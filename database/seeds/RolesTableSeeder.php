<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\assignRole;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Role::create(['name' => 'super-admin', 'guard_name'	=> 'web']); 
    	Role::create(['name' => 'manager', 'guard_name'	=> 'web']); 
    	Role::create(['name' => 'user', 'guard_name'	=> 'web']); 

    }
}
