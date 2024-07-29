<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
	use HasFactory;

	protected $table = 'contracts';

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
