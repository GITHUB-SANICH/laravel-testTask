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
        Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
            $table->string('name');
			$table->enum('role', ['client', 'admin']);
			$table->integer('contract_id')->unsigned()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
			$table->softDeletes();

			// Добавляем внешний ключ с каскадным удалением
			$table->foreign('contract_id')
			->references('id')
			->on('contracts')
			->nullOnDelete();
        });
    }
	 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
		Schema::table('users', function (Blueprint $table) {
			// Удаляем внешний ключ перед удалением таблицы
			$table->dropForeign(['contract_id']);
		});

        Schema::dropIfExists('users');
    }
};
