<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SimCard extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'number', 'contract_id',
	];

	public function contract()
	{
		return $this->belongTo(Contract::class);
	}

	public function simCardGroups()
	{
		//return $this->belongsToMany(SimCardGroup::class);
		return $this->belongsToMany(SimCardGroup::class, 'sim_card_sim_card_group', 'sim_card_id', 'sim_card_group_id');
	}
}
