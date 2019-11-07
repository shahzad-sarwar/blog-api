<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Spatie\Permission\Traits\assignRole;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 4)->create([
			'user_id' => $user = factory(App\User::class)->create(['password' => 'admin123']),
		]);
		$user->assignRole('super-admin');
    }
}
