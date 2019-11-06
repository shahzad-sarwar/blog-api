<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Traits\assignRole;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$admin = factory(App\User::class)->create(['email' => 'admin@blog.com']);
        $admin->assignRole('super-admin');

    	$manager = factory(App\User::class)->create(['email' => 'manager@blog.com']);
        $manager->assignRole('manager');

    	$user = factory(App\User::class)->create(['email' => 'user@blog.com']);
        $user->assignRole('user');
    }
}
