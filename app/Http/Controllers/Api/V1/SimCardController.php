<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SimCardResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SimCard;


class SimCardController extends Controller
{

	public function __invoke()
	{
		return ['проверка'];
	}

	public function index(Request $request)
	{
		return ['проверка-index-test'];
	}


	public function searchByNumber($number)
	{
		$user = Auth::user();
		$query = SimCard::where('number', 'like', "%$number%");
	
		if ($user->role === 'client') {
			$query->where('contract_id', $user->contract_id)
				->join('sim_card_sim_card_group', 'sim_cards.id', '=', 'sim_card_sim_card_group.sim_card_id')
				->orderBy('sim_card_sim_card_group.sim_card_group_id')->select('sim_cards.id', 'sim_cards.number', 'sim_card_sim_card_group.sim_card_group_id');
			return SimCardResource::collection($query);
		}

		if ($user->role === 'admin') {
			$query->where('contract_id', $user->contract_id)
				->join('sim_card_sim_card_group', 'sim_cards.id', '=', 'sim_card_sim_card_group.sim_card_id')
				->orderBy('sim_card_sim_card_group.sim_card_group_id');
			//return SimCardResource::collection($query);
		}

		//$simCards = $query->get();
		//return SimCardResource::collection($simCards);
		//return response()->json($simCards);
	}
}
