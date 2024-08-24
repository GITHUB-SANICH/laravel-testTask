<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class SimCardResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$user = Auth::user()->role;

		if ($user === 'client') {
			return [
				'sim' => $this->id,
				'phone_number' => $this->number,
				'group' => $this->simCardGroups->pluck('pivot.sim_card_group_id')->all()
			];
		}

		if ($user === 'admin') {
			return [
				'sim' => $this->id,
				'phone_number' => $this->number,
				'contract' => $this->contract_id
			];
		}
	}
}