<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Contract\StoreContractRequest;
use App\Http\Resources\Api\V1\ContractResource;
use App\Models\Contract;
use Illuminate\Support\Facades\Cache;

class ContractController extends Controller
{
	public function getAllContracts()
	{
		return ContractResource::collection(Cache::remember('contract_list', 60 * 60 * 24, function () {
			return Contract::all();
		}));
	}

	public function store(StoreContractRequest $request)
	{
		$newContract = Contract::create(['name' => $request->validated()['contractName']]);
		return new ContractResource($newContract, 201);
	}
}