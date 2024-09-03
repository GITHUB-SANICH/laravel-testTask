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
		Schema::create('sim_cards', function (Blueprint $table) {
			$table->increments('id');
			$table->string('number')->unique();
			$table->integer('contract_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();

			// Добавляем внешний ключ с каскадным удалением
			$table->foreign('contract_id')
			->references('id')
			->on('contracts')
			->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('sim_cards', function (Blueprint $table) {
			// Удаляем внешний ключ перед удалением таблицы
			$table->dropForeign(['contract_id']);
		});

		Schema::dropIfExists('sim_cards');
	}
};
