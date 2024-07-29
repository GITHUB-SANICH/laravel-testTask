<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimCardGroup extends Model
{
	use HasFactory;

	protected $table = 'sim_card_groups';

	protected $fillable = [
		'name', 'contract_id'
	];

	public function contracts()
	{
		return $this->belongTo(Contract::class, 'contract_id');
	}

	public function simCards()
	{
		return $this->belongsToMany(SimCard::class, 'sim_card_sim_card_group');
	}
}
