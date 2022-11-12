<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('slug')->nullable();
            $table->longText('logo')->nullable();
            $table->longText('methods')->nullable();
            $table->string('status')->default('inactive');
            $table->longText('token')->nullable();
            $table->longText('data')->nullable();
            $table->timestamps();
        });

        DB::table('payments')->insert([
            ['name' => 'asaas', 'slug' => 'asaas', 'status' => 'inactive'],
            ['name' => 'gerencianet', 'slug' => 'gerencianet', 'status' => 'inactive'],
            ['name' => 'deposito', 'slug' => 'deposito', 'status' => 'active'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('payments');
    }
};
