<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SimCard;
use App\Models\SimCardsGroup;
use Database\Factories\SimCardFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
	{
		$this->call([
			ContractSeeder::class,
			UserSeeder::class,
			SimCardSeeder::class,
			SimCardGroupSeeder::class,
			SimCardSimCardGroupSeeder::class,
		]);
    }
}
