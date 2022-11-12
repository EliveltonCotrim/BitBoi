<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('operation', 1)->comment('d|c');
            $table->string('reference', 500)->nullable(true);
            $table->string('coin', 50);
            $table->decimal('value', 16, 8);
            $table->decimal('courentBalance', 16, 8);
            $table->decimal('previousBalance', 16, 8);
            $table->string('observation', 900)->nullable(true)->default(null);
            $table->string('status', 100)->default('lancado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('balances');
    }
};
