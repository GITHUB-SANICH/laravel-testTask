<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\SocialNetwork;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'name', 'email', 'password', 'role', 'contract_id',
    ];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $table = 'users';
    protected $hidden = [
        'password',
        'remember_token',
    ];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
    protected $casts = [
        'email_verified_at' => 'datetime',
		'password' => 'hashed',
    ];


	public function contract()
	{
		return $this->belongTo(Contract::class);
	}
}