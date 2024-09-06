<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SimCardGroup;
use App\Models\SimCard;
use Illuminate\Http\Request;
use App\Http\Resources\SimCardGroupResource;
use App\Http\Requests\SimCardGroupForm;
use Illuminate\Support\Facades\Validator;

class SimCardGroupController extends Controller
{
	public function getAllGroups(SimCardGroupForm $request)
	{
		$entries = $request->query('entries', $request->validated()['entries']);
		$simCardGroups = SimCardGroup::with('simCards')->paginate($entries);

		return SimCardGroupResource::collection($simCardGroups);
	}

	public function getGroup($groupId)
	{
		// Валидация $groupId
		$validator = Validator::make(['groupId' => $groupId], [
			'groupId' => 'required|integer|min:1'
		]);

		if ($validator->fails()) {
			return response()->json(['error' => 'Неверный идентификатор группы'], 400);
		}

		// Получаем максимальное значение ID из таблицы
		$maxGroupId = SimCardGroup::max('id');

		// Если $groupId больше максимального, заменяем его на максимальное
		if ($groupId > $maxGroupId) {
			$groupId = $maxGroupId;
		}

		$simCardGroup = SimCardGroup::with('simCards')->find($groupId);
		

		if (!$simCardGroup) {
			return response()->json(['error' => 'Группа не найдена'], 404);
		}

		return new SimCardGroupResource($simCardGroup);
	}

	public function addSimCard($groupId, SimCardGroupForm $request)
	{
		// Получение группы по ID
		$group = SimCardGroup::findOrFail($groupId);

		// Получение сим-карты по ID
		$simCard = SimCard::findOrFail($request->addedSimCardId);

		// Проверка, есть ли сим-карта уже в группе
		if ($group->simCards()->where('sim_card_id', $simCard->id)->exists()) {
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
		$group = SimCardGroup::findOrFail($groupId);

		// Проверка, есть ли сим-карта в группе
		if (!$group->simCards()->where('sim_card_id', $simCardId)->exists()) {
			return response()->json(['error' => 'Сим-карта не найдена в этой группе'], 404);
		}

		// Удаление сим-карты из группы
		$group->simCards()->detach($simCardId);

		return response()->json(['message' => 'Сим-карта успешно удалена из группы'], 200);
	}

	public function store(Request $request)
	{
		// Валидация входных данных
		$validatedData = $request->validate([
			'name' => 'required|string|max:50',
		]);

		// Создание группы сим-карт
		$group = SimCardGroup::create($validatedData);

		return response()->json([
			'message' => 'Группа сим-карт успешно создана.',
			'group' => $group,
		], 201);
	}
}
