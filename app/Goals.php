<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goals extends Model
{
    protected $table = 'goals';
    protected $fillable = [
        'goal_name', 
        'goal_process', 
        'goal_status', 
        'employee_status',
        'employee_tb_status',
        'supervisor_status',
        'supervisor_tb_status',
        'supervisor_pip_exit',
        'sup_movement_process',
        'reviewer_status',
        'hr_status',
        'bh_status',
        'employee_summary',
        'supervisor_summary',
        'employee_consolidated_rate', 
        'supervisor_consolidated_rate', 
        'goal_unique_code', 
        'created_by', 
        'created_by_name'
    ];
}
