<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SimCardResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		//return parent::toArray($request);
		return [
			'sim' => $this->id,
			'phone_number' => $this->number,
			'group' => $this->simCardGroups->pluck('id')->first()
		];
	}
}
