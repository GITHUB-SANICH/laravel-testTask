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
			$query->where('contract_id', $user->contract_id);
		}

		$simCards = $query->get();

		return response()->json($simCards);
		//return new SimCardResource();
	}
}
