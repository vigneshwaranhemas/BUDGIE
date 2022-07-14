<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HolidayState extends Model
{
    protected $table = 'holiday_states';
    protected $fillable = ['state_name', 'holiday_code'];
}
