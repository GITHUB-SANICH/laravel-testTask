<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SimCard;
use App\Http\Resources\SimCardResource;
use App\Http\Requests\SimCard\GetAllSimCardsRequest;

class SimCardController extends Controller
{
	public function getAllSimCards(GetAllSimCardsRequest $request)
	{
		$user = Auth::user();
		$validatedNumber = $request->validated()['number'];
		$query = SimCard::where('number', 'like', "%$validatedNumber%");

		if ($user->role === 'client') {
			$simCards = $query->where('contract_id', $user->contract_id)->with('simCardGroups')->get()->sortBy('simCardGroups');
		}

		if ($user->role === 'admin') {
			$simCards = $query->orderBy('contract_id')->get();
		}

		return SimCardResource::collection($simCards);
	}
}