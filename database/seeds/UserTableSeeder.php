<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	   User::create([
			'name' => 'Ravialdo',
			'email' => 'ravialdo@extreme.com',
			'level_id' => 1,
			'password' => Hash::make('ravialdo')
	   ]);
	
        User::create([
			'name' => 'admin',
			'email' => 'admin@extreme.com',
			'level_id' => 1,
			'password' => Hash::make('admin')
	   ]);
	
	   User::create([
			'name' => 'user',
			'email' => 'user@extreme.com',
			'level_id' => 2,
			'password' => Hash::make('user')
	   ]);
    }
}
