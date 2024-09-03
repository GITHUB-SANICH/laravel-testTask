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
			$table->increments('id');
			$table->integer('sim_card_id')->unsigned();
			$table->integer('sim_card_group_id')->unsigned();
			$table->timestamps();

			// Добавляем внешний ключ с каскадным удалением
			$table->foreign('sim_card_id')
			->references('id')
			->on('sim_cards')
			->onDelete('cascade');

			$table->foreign('sim_card_group_id')
			->references('id')
			->on('sim_card_groups')
			->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('sim_card_sim_card_group', function (Blueprint $table) {
			// Удаляем внешние ключи перед удалением таблицы
			$table->dropForeign(['sim_card_id']);
			$table->dropForeign(['sim_card_group_id']);
		});

		Schema::dropIfExists('sim_card_sim_card_group');
	}
};
