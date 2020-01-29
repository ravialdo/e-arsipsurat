<?php

use Illuminate\Database\Seeder;

use App\MailType;

class MailTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	   $data = [
	   		'surat masuk',
			'surat keluar'
	   ];
	
	   foreach($data as $key):
        		MailType::create([
				'type_name' => $key
	   		]);
	   endforeach;
    }
}
