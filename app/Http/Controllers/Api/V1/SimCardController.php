<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SimCard;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\SimCardResource;


class SimCardController extends Controller
{
	public function index($number = null)
	{
		$user = Auth::user();
		$query = SimCard::where('number', 'like', "%$number%");
		$simCards = $query->find(21)->simCardGroups;
		foreach ($simCards as $e) {
			$e->id;
		}

		if ($user->role === 'client') {
			$simCards = $query->where('contract_id', $user->contract_id)
				->with('simCardGroups')->get()
				->sortBy(function ($query) {
					// Сортировка по первому ID группы сим карты (если есть)
					return $query->simCardGroups->isNotEmpty()
						? $query->simCardGroups->first()->pivot->sim_card_group_id
						: PHP_INT_MAX;
				});

			//так же был написан запрос чреез JOIN, но полагаю он не релевантен
			//$query->where('contract_id', $user->contract_id)
			//	->join('sim_card_sim_card_group', 'sim_cards.id', '=', 'sim_card_sim_card_group.sim_card_id')
			//->orderBy('sim_card_sim_card_group.sim_card_group_id')->select('sim_cards.id as simka', 'sim_cards.number as telephone', 'sim_card_sim_card_group.sim_card_group_id as group');
		}

		if ($user->role === 'admin') {
			$simCards = Cache::remember('sim_card_list_for_admin', 60 * 60 * 24, function ($query) {
				$query->orderBy('contract_id')->get();
			});
		}

		//return SimCardResource::collection($simCards);
		return response()->json($simCards);
	}
}