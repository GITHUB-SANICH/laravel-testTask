<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SimCardGroup;
use App\Http\Resources\Api\V1\SimCardGroupResource;

use App\Http\Requests\Api\V1\SimCardGroup\AddSimCardRequest;
use App\Http\Requests\Api\V1\SimCardGroup\GetAllGroupsRequest;
use App\Http\Requests\Api\V1\SimCardGroup\StoreSimCardGroupRequest;

class SimCardGroupController extends Controller
{
	public function getAllGroups(GetAllGroupsRequest $request)
	{
		$entriesOnPage = $request->query('entries', $request->validated());
		$simCardGroups = SimCardGroup::with('simCards')->paginate($entriesOnPage);

		return SimCardGroupResource::collection($simCardGroups);
	}

	public function getGroup($groupId)
	{
		// Получение группы по ID
		$group = SimCardGroup::find($groupId);
		if (!$group) {
			return response()->json([
				'message' => 'Группа сим-карт не найдена.',
			], 404);
		}

		$group = $group->with('simCards')->find($groupId);
		return new SimCardGroupResource($group);
	}

	public function addSimCard($groupId, AddSimCardRequest $request)
	{
		// Получение группы по ID
		$group = SimCardGroup::find($groupId);
		if (!$group) {
			return response()->json([
				'message' => 'Группа сим-карт не найдена.',
			], 404);
		}

		// Получение сим-карты по ID
		$simCard = $request->validated()['addedSimCard'];

		// Проверка, есть ли сим-карта уже в группе
		if ($group->simCards()->where('sim_card_id', $simCard)->exists()) {
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
		// Получение группы по ID
		$group = SimCardGroup::find($groupId);
		if (!$group) {
			return response()->json([
				'message' => 'Группа сим-карт не найдена.',
			], 404);
		}

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
		$group = new SimCardGroup();
		$group->name = $request->validated()['groupName'];
		$group->contract_id = $request->validated()['contract'];
		$group->save();

		return response()->json([
			'message' => 'Группа сим-карт успешно создана.',
			'group' => $group,
		], 201);
	}

	public function destroy($groupId)
	{
		$group = SimCardGroup::find($groupId);
		if (!$group) {
			return response()->json([
				'message' => 'Группа сим-карт не найдена.',
			], 404);
		}

		// Удаление группы
		$group->delete();

		return response()->json([
			'message' => 'Группа сим-карт успешно удалена.',
		], 200);
	}
}
