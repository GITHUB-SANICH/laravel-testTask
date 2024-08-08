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

		if ($user->role === 'client') {
			$simCards = Cache::remember('sim_card_list_for_client', 60 * 60 * 24, function () use ($query, $user) {
				return $query->where('contract_id', $user->contract_id)->with('simCardGroups')->get()->sortBy('simCardGroups');
			});
		}

		if ($user->role === 'admin') {
			$simCards = Cache::remember('sim_card_list_for_admin', 60 * 60 * 24, function () use ($query) {
				return $query->orderBy('contract_id')->get();
			});
		}

		return SimCardResource::collection($simCards);
	}
}