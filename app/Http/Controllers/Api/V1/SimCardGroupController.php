<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SimCardGroup;
use App\Models\SimCard;
use Illuminate\Http\Request;
use App\Http\Resources\SimCardGroupResource;

class SimCardGroupController extends Controller
{
	public function getAllGroups(Request $request)
	{
		$entries = $request->query('entries', $request->entries);
		$simCardGroups = SimCardGroup::with('simCards')->paginate($entries);

		return SimCardGroupResource::collection($simCardGroups);
	}

	public function getGroup($groupId)
	{
		$simCardGroup = SimCardGroup::with('simCards')->find($groupId);

		if (!$simCardGroup) {
			return response()->json(['error' => 'Group not found'], 404);
		}

		return new SimCardGroupResource($simCardGroup);
	}

	public function addSimCard($groupId, Request $request)
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
			return response()->json(['error' => 'Sim card not found in this group'], 404);
		}

		// Удаление сим-карты из группы
		$group->simCards()->detach($simCardId);

		return response()->json(['message' => 'Sim card removed successfully'], 200);
	}
}
