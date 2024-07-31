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
}
