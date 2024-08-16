<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContractForm;
use App\Http\Resources\ContractResource;
use App\Models\Contract;
use Illuminate\Support\Facades\Cache;

class ContractController extends Controller
{
	public function index()
	{
		return ContractResource::collection(Cache::remember('contract_list', 60 * 60 * 24, function () {
			return Contract::all();
		}));
	}

	public function store(ContractForm $request)
	{
		$newContract = Contract::create($request->validated());
		return new ContractResource($newContract, 201);
	}
}
