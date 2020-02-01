<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = [
        	'mail_code', 'mail_from', 'mail_to', 'mail_subject', 'description', 'file', 'mail_type_id', 'user_id'
    ];

	public function mail_type()
	{
		return $this->belongsTo(MailType::class);
	}
	public function disposition(){
		return $this->hasOne(Disposition::class);
	}
}
