<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contract;
use App\Models\SimCard;
use App\Models\SimCardGroup;
use App\Models\User;
use App\Models\SimCardsGroup;
use App\Models\SimCardSimCardGroup;
use Database\Factories\SimCardFactory;
use Illuminate\Support\Facades\Hash;
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

		Contract::create(['id' => 11, 'name' => 'test_contract-1']);
		Contract::create(['id' => 12, 'name' => 'test_contract-2']);
		User::create(['name' => 'client', 'email' => 'client@mail.ru', 'role' => 'client', 'contract_id' => 11, 'password' => Hash::make('client')]);
		User::create(['name' => 'admin', 'email' => 'admin@mail.ru', 'role' => 'admin', 'password' => Hash::make('admin')]);
		SimCard::create(['number' => '+7-904-222-333-11', 'contract_id' => 11]);
		SimCard::create(['number' => '+7-999-333-111-22', 'contract_id' => 11]);
		SimCardGroup::create(['name' => 'groupe1', 'contract_id' => 11]);
		SimCardGroup::create(['name' => 'groupe2', 'contract_id' => 12]);
		SimCardSimCardGroup::create(['sim_card_id' => 21, 'sim_card_group_id' => 12]);
		SimCardSimCardGroup::create(['sim_card_id' => 22, 'sim_card_group_id' => 11]);
    }
}
