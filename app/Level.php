<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected  $fillable = [
    		'level_name'
    ];

  /**
    * One to One Level > User
    *
    * @return void
    */
	public function user()
	{
		return $this->hasOne(User::class);
	}
}
