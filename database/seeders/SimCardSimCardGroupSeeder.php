<?php

namespace Database\Seeders;

use App\Models\SimCardSimCardGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SimCardSimCardGroupSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		SimCardSimCardGroup::factory()->count(40)->create();
	}
}
