<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StickyNotesModel extends Model
{
    protected $gaurded=[];
    protected $table="sticky_notes";
}
