<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holidays extends Model
{
    protected $table = 'holidays';
    protected $fillable = ['occassion', 'date', 'description', 'created_by', 'holiday_unique_code', 'all_state'];
}
