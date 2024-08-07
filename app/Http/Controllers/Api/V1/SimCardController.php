<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SimCard;
use App\Http\Resources\SimCardResource;


class SimCardController extends Controller
{
	public function index($number = null)
	{
		$user = Auth::user();
		$query = SimCard::where('number', 'like', "%$number%");

		if ($user->role === 'client') {
			$simCards = $query->where('contract_id', $user->contract_id)->get()->sortBy(function ($query) {
				return $query->simCardGroups->isNotEmpty() ? $query->simCardGroups->first()->pivot->sim_card_group_id : PHP_INT_MAX;
			});

			//выводитс с сортировкой
			//$query->where('contract_id', $user->contract_id)
			//	->join('sim_card_sim_card_group', 'sim_cards.id', '=', 'sim_card_sim_card_group.sim_card_id')
			//->orderBy('sim_card_sim_card_group.sim_card_group_id')->select('sim_cards.id as simka', 'sim_cards.number as telephone', 'sim_card_sim_card_group.sim_card_group_id as group');
		}

		if ($user->role === 'admin') {
			$simCards = $query->orderBy('contract_id')->get();
		}

		return SimCardResource::collection($simCards);
		//return response()->json($simCards);
	}
}