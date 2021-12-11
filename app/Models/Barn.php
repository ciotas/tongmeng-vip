<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Barn extends Model
{
	use HasDateTimeFormatter;    
	protected $casts = [
        'images' => 'json'
    ];
}
