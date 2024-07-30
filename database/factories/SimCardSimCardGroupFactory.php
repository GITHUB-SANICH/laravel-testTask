<?php

namespace Database\Factories;

use App\Models\SimCard;
use App\Models\SimCardGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SimCardSimCardGroup>
 */
class SimCardSimCardGroupFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'sim_card_id' => SimCard::factory(),
			'sim_card_group_id' => SimCardGroup::factory()
		];
	}
}
