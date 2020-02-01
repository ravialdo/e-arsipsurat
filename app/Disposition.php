<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    protected $fillable = [
		'disposition_to', 'type_mail_disposition', 'description','status_disposition', 'status', 'mail_id', 'user_id'
    ];

	public function user(){
		return $this->belongsTo(User::class,'disposition_to');
	}
}
