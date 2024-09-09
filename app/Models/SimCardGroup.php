<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SimCardGroup extends Model
{
	use HasFactory, SoftDeletes;

	protected $table = 'sim_card_groups';
	protected $fillable = [
		'name',
	];

	protected $casts = [
		'contract_id' => 'integer',
	];

	public function contract()
	{
		return $this->belongTo(Contract::class);
	}

	public function simCards()
	{
		return $this->belongsToMany(SimCard::class)->withTimestamps();
	}
}