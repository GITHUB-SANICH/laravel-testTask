<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class SimCardGroupResource extends JsonResource
{
	public static $wrap = '';
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
			'sim_cards' => $this->simCards->isEmpty() ? 'В данной группе сим-карт нет' : $this->simCards->map(function ($simCard) {
				return [
					'simCard_id' => $simCard->id,
					'number' => $simCard->number,
					'time_add_sim' => $simCard->pivot->created_at ? $simCard->pivot->created_at->format('H:i_d.m.Y') : 'No Date',
				];
			}),
		];
	}
}
