<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContractForm;
use App\Http\Resources\ContractCollection;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContractController extends Controller
{
	public function index()
	{
		return new ContractCollection(Cache::remember('contract_list', 60 * 60 * 24, function () {
			Contract::all();
		}));
	}


	public function store(ContractForm $request)
	{
		$newContract = Contract::create($request->validated());
		return response()->json($newContract, 201);
	}

	public function cache()
	{
		$cachedData = Cache::get('contract_list');

		if ($cachedData) {
			return response()->json(['status' => 'found', 'data' => $cachedData], 200);
		} else {
			return response()->json(['status' => 'not found'], 404);
		}
	}
}
