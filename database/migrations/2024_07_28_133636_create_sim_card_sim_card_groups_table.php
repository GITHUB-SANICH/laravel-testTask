<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('sim_card_sim_card_group', function (Blueprint $table) {
			$table->id();
			$table->foreignId('sim_card_id')->constrained()->cascadeOnDelete();
			$table->foreignId('sim_card_group_id')->constrained()->cascadeOnDelete();

			$table->index('sim_card_id', 'sim_card_sim_card_group_sim_card_fk')->on('sim_cards')->references('id');
			$table->index('sim_card_group_id', 'sim_card_sim_card_group_sim_card_group_fk')->on('sim_card_groups')->references('id');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('sim_card_sim_card_group');
	}
};
