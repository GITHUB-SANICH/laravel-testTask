<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SimCard;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\SimCardResource;


class SimCardController extends Controller
{
	public function index($number = null)
	{
		$user = Auth::user();
		$query = SimCard::where('number', 'like', "%$number%");
		if ($user->role === 'client') {
			$simCards = $query->where('contract_id', $user->contract_id)
				->with(['simCardGroups' => function ($query) {
					$query->orderBy('sim_card_group_id', 'asc');
				}])
				->get()
				->map(function ($simCard) {
					// Сортируем simCardGroups и берем только первый элемент
					$simCard->simCardGroups = $simCard->simCardGroups->sortBy('pivot.sim_card_group_id')->values();
					// Удаляем дублирующее поле sim_card_groups
					unset($simCard->sim_card_groups);
					return $simCard;
				})
				->sortByDesc(function ($simCard) {
					// Сортируем всю коллекцию по id
					return $simCard->id;
				})
				->values();


				
			//$simCards = $query->where('contract_id', 'like', $user->contract_id)
			//	->with(['simCardGroups' => function ($query) {
			//		$query->orderBy('sim_card_group_id', 'asc');
			//	}])->get()
			//	->map(function ($simCard) {
			//		// Оставляем только первый элемент в коллекции simCardGroups
			//		$simCard->simCardGroups = $simCard->simCardGroups->take(1);
			//		return $simCard;
			//	});
		  


			//$simCards = $query->with(['simCardGroups' => function ($query) {
			//	$query->orderBy('pivot.sim_card_group_id', 'asc');
			//}])->get();
			//// Сортировка на уровне коллекции по первому элементу в `simCardGroups`
			//$simCards = $simCards->sortBy(function ($simCard) {
			//	return $simCard->simCardGroups->first()->pivot->sim_card_group_id ?? null;
			//})->values();

//рабочий вариант
			//$simCards = $query->where('contract_id', $user->contract_id)
			//	->with('simCardGroups')->get()
			//	->sortBy(function ($simCard) {
			//	// Сортировка по первому ID группы сим карты (если есть)
			//	return $simCard->simCardGroups->isNotEmpty()
			//		? $simCard->simCardGroups->first()->pivot->sim_card_group_id
			//			: PHP_INT_MAX;
			//	});

		}

		if ($user->role === 'admin') {
			$simCards = Cache::remember('sim_card_list_for_admin', 60 * 60 * 24, function () use ($query) {
				return $query->orderBy('contract_id')->get();
			});
		}

		//return SimCardResource::collection($simCards);
		return response()->json($simCards);
	}
}