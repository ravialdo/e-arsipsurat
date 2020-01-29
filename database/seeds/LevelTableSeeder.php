<?php

use Illuminate\Database\Seeder;

use App\Level;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	   $data = [
			'admin',
			'user'
	   ];
	
	   foreach($data as $key):
        		Level::create([
				'level_name' => $key
	  		 ]);
	   endforeach;
    }
}
