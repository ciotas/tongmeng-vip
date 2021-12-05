<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
	use HasDateTimeFormatter;   
	
	public function exchange()
	{
		return $this->belongsTo(Exchange::class);
	}

}
