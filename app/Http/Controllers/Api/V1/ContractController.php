<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContractCollection;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContractController extends Controller
{
	public function index()
	{
		return new ContractCollection(Cache::remember('contract_list', 60 * 60 * 24, function () {
			return Contract::all();
		}));
	}

	public function store(Request $request)
	{
		$validatedData = $request->validate([
			'name' => 'required|string|max:255',
		]);

		$contract = Contract::create($validatedData);

		return response()->json($contract, 201);
	}
}
