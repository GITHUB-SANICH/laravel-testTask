<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SimCardGroup extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'name', 'contract_id'
	];

	public function contract()
	{
		return $this->belongTo(Contract::class, 'contract_id');
	}

	public function simCards()
	{
		return $this->belongsToMany(SimCard::class, 'sim_card_id');
	}
}
