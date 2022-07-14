<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CustomUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'customusers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'empID','username','email', 'passcode','role_type','pre_onboarding','active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'passcode', 'remember_token',
    ];


    public function getAuthPassword()
    {
      return $this->passcode;
    }
}
