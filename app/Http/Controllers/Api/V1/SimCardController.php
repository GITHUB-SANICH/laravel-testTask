<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SimCard;

class SimCardController extends Controller
{
	public function index(Request $request)
	{
	}


	public function searchByNumber($number)
	{
		$user = Auth::user();
		$query = SimCard::where('number', 'like', "%$number%");;

		if ($user->role === 'client') {
			$query->where('contract_id', $user->contract_id);
		}

		if ($user->role === 'admin') {
			$query->where('contract_id', $user->contract_id);
		}

		$simCards = $query->get();

		return response()->json($simCards);
	}
}
