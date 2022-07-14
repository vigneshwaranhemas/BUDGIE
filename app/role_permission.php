<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role_permission extends Model
{
    protected $gaurded = [];
    protected $table = "role_permissions";
}
