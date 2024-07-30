<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'name',
	];

	public function simCards()
	{
		$this->hasMany(SimCard::class, 'sim_card_id');
	}

	public function simCardGroups()
	{
		$this->hasMany(SimCardGroup::class, 'sim_card_group_id');
	}

	public function users()
	{
		$this->hasMany(User::class, 'user_id');
	}
}
