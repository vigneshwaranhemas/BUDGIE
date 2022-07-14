<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class documents extends Model
{
    protected $fillable = [
      'emp_id','doc_name','path'
    ];
}
