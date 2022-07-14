<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventAttendee extends Model
{
    protected $table = 'event_attendees';
    protected $fillable = ['candidate_name', 'event_id'];
}
