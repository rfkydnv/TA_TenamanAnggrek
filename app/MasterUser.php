<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class MasterUser extends Authenticatable
{
    //
    use Notifiable;

    protected $table = 'master_user';
    protected $primaryKey = 'user_id';
    
    protected $dates = [
		'user_created_at',
		'user_updated_at'
	];

	const CREATED_AT      = 'user_created_at';
	const UPDATED_AT      = 'user_updated_at';


    protected $fillable = [
    	'user_fullname','user_username','user_password','user_email','user_is_active'
    ];

    protected $hidden = [
        'user_password', 'user_remember_token'
    ];

    protected $casts = [
        'user_email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
    	return $this->user_password;
    }
}
