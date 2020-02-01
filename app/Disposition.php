<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    protected $fillable = [
		'disposition_to', 'type_mail_disposition', 'description', 'mail_id', 'user_id'
    ];
}
