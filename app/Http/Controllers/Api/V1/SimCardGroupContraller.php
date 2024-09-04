<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SimCardGroup;
use Illuminate\Http\Request;
use App\Http\Resources\SimCardGroupResource;

class SimCardGroupContraller extends Controller
{
	public function index(Request $request)
	{
		$entries = $request->query('entries', 10);
		$simCardGroups = SimCardGroup::with('simCards')->paginate($entries);

		return SimCardGroupResource::collection($simCardGroups);
	}
}
