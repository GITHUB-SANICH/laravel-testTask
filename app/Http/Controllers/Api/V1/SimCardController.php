<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SimCardCollection;
use App\Http\Resources\SimCardResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SimCard;
use App\Models\SimCardGroup;
use App\Models\SimCardSimCardGroup;

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
		//$query = SimCard::where('number', 'like', "%$number%");
		$query = SimCard::all()->sortBy('contract_id');


		if ($user->role === 'client') {
			$query->where('contract_id', $user->contract_id);

			//return new SimCardResource($query);
		}

		//$simCards = $query->get();
		//return response()->json($simCards);
		return response()->json($query);

		//return new SimCardCollection($simCards);
		//return response()->json($simCards);
	}
}
