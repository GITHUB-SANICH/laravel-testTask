<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
	public function index()
	{
		$contracts = Contract::all();
		return response()->json($contracts);
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
