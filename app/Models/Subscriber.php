<?php

namespace App\Models;

use Dcat\Admin\Admin;
use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
	use HasDateTimeFormatter;    

	public function admin_user()
	{
		return $this->belongsTo(AdminUser::class);
	}
}
