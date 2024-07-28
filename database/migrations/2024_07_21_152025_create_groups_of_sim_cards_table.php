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
		Schema::create('sim_card_groups', function (Blueprint $table) {
			$table->id();
			$table->string('name', 50);
			$table->foreignId('contract_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('sim_card_groups');
	}
};
