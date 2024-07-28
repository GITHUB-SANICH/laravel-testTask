<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimCard extends Model
{
	use HasFactory;
	protected $table = 'sim_cards';

	protected $fillable = [
		'number', 'contract_id',
	];

	public function contracts()
	{
		return $this->belongTo(Contract::class, 'contract_id');
	}

	public function simCardGroups()
	{
		return $this->belongsToMany(SimCardsGroup::class, 'sim_card_sim_card_group');
	}
}
