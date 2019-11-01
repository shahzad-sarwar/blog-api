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
    	factory(App\User::class)->create(['email' => 'admin@blog.com'])->each(function ($user) {
    		$user->assignRole('super-admin');
    	});

    	factory(App\User::class)->create(['email' => 'manager@blog.com'])->each(function ($user) {
    		$user->assignRole('manager');
    	});

    	factory(App\User::class)->create(['email' => 'user@blog.com'])->each(function ($user) {
    		$user->assignRole('user');
    	});
    }
}
