<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
	use HasFactory, SoftDeletes;

	protected $table = 'contracts';
	protected $fillable = [
		'name',
	];

	public function simCards()
	{
		$this->hasMany(SimCard::class);
	}

	public function simCardGroups()
	{
		$this->hasMany(SimCardGroup::class);
	}

	public function users()
	{
		$this->hasMany(User::class);
	}
}
