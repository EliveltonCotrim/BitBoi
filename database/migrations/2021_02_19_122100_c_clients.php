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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('rg')->nullable();
            $table->string('phone')->nullable();
            $table->string('uf')->nullable();
            $table->string('city')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('number')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->nullable();
            $table->string('avatar')->nullable();
            $table->string('status')->default('pendente');
            $table->string('emailValidated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('clients');
    }
};
