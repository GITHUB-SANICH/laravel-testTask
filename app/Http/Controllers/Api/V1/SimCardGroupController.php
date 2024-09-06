<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SimCardGroup;
use App\Models\SimCard;
use App\Http\Resources\SimCardGroupResource;
use App\Http\Requests\SimCardGroup\AddSimCardRequest;
use App\Http\Requests\SimCardGroup\GetAllGroupsRequest;
use App\Http\Requests\SimCardGroup\StoreSimCardGroupRequest;

class SimCardGroupController extends Controller
{
	public function getAllGroups(GetAllGroupsRequest $request)
	{
		$entries = $request->query('entries', $request->validated()['entries']);
		$simCardGroups = SimCardGroup::with('simCards')->paginate($entries);

		return SimCardGroupResource::collection($simCardGroups);
	}

	public function getGroup($groupId)
	{
		// Получение группы по ID
		$group = SimCardGroup::findOrFail($groupId);

		$group = $group->with('simCards')->find($groupId);
		return new SimCardGroupResource($group);
	}

	public function addSimCard($groupId, AddSimCardRequest $request)
	{
		// Получение группы по ID
		$group = SimCardGroup::findOrFail($groupId);

		// Получение сим-карты по ID
		//$simCard = SimCard::findOrFail($request->addedSimCard);
		$simCard = $request->validated()['entries'];


		// Проверка, есть ли сим-карта уже в группе
		if ($group->simCards()->where('sim_card_id', $simCard)->exists()) {
		//if ($group->simCards()->where('sim_card_id', $simCard->id)->exists()) {
			return response()->json([
				'message' => 'Сим-карта уже находится в этой группе.',
			], 400);
		}

		// Добавление сим-карты в группу
		$group->simCards()->attach($simCard);

		return response()->json([
			'message' => 'Сим-карта успешно добавлена в группу.',
			'group' => $group,
			'sim_card' => $simCard,
		], 200);
	}

	public function removeSimCard($groupId, $simCardId)
	{
		$group = SimCardGroup::findOrFail($groupId);

		// Проверка, есть ли сим-карта в группе
		if (!$group->simCards()->where('sim_card_id', $simCardId)->exists()) {
			return response()->json(['error' => 'Сим-карта не найдена в этой группе'], 404);
		}

		// Удаление сим-карты из группы
		$group->simCards()->detach($simCardId);

		return response()->json(['message' => 'Сим-карта успешно удалена из группы'], 200);
	}

	public function store(StoreSimCardGroupRequest $request)
	{
		// Создание группы сим-карт
		$group = SimCardGroup::create(['name' => $request->validated()['groupName'],
			'contract_id' => $request->validated()['contract']
		]);

		return response()->json([
			'message' => 'Группа сим-карт успешно создана.',
			'group' => $group,
		], 201);
	}
}
