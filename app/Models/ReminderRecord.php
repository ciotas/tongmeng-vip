<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class ReminderRecord extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'reminder_records';
    protected $fillable = ['reminder_id', 'price'];
}
