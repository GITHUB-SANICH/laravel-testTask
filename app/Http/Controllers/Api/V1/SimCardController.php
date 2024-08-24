<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SimCard;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\SimCardResource;
use App\Http\Requests\SimCardForm;

class SimCardController extends Controller
{
	public function index(SimCardForm $request)
	{
		$user = Auth::user();
		$validatedNumber = $request->validated()['number'];
		$query = SimCard::where('number', 'like', "%$validatedNumber%");

		// Определяем кешированный ключ
		$cacheKey = $this->getCacheKey($user->role, $validatedNumber);

		// Очищаем кеш перед обновлением
		Cache::forget($cacheKey);

		if ($user->role === 'client') {
			$simCards = Cache::remember($cacheKey, 60 * 60 * 24, function () use ($query, $user) {
				return $query->where('contract_id', $user->contract_id)->with('simCardGroups')->get()->sortBy('simCardGroups');
			});
		}

		if ($user->role === 'admin') {
			$simCards = Cache::remember($cacheKey, 60 * 60 * 24, function () use ($query) {
				return $query->orderBy('contract_id')->get();
			});
		}

		return SimCardResource::collection($simCards);
	}

	private function getCacheKey($role, $number)
	{
		return "sim_card_list_for_{$role}_" . md5($number);
	}
}