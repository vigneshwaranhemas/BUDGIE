<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeopleStar extends Model
{
    protected $table = 'people_stars';
    protected $fillable = ['created_by', 'starred'];
}
