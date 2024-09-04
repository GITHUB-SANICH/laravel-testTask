<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SimCardGroupResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray($request)
	{
		return [
			'group_id' => $this->id,
			'group_name' => $this->name,
			'sim_cards' => $this->simCards->map(function ($simCard) {
				return [
					'simCard_id' => $simCard->id,
					'number' => $simCard->number,
					'time_add_sim' => $simCard->pivot->created_at ? $simCard->pivot->created_at->format('H:i_d.m.Y') : 'No Date',
				];
			}),
		];
	}
}
