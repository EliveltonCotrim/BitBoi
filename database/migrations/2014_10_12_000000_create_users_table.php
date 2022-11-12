<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('cpf');
            $table->string('password');
            $table->string('type')->default('client');
            $table->string('cell')->nullable();
            $table->string('codigo_assas')->nullable();
            $table->unsignedBigInteger('sponsor');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'id' => 1,
                'sponsor' => 0,
                'name' => 'admin',
                'user' => 'admin',
                'email' => '1',
                'cpf' => '111.111.111-11',
                'password' => Hash::make('1'),
                'type' => 'admin',
            ],
            [
                'id' => 2,
                'sponsor' => 1,
                'name' => 'Teste J',
                'user' => 'testej',
                'email' => 'j@j.com',
                'cpf' => '222.222.222-22',
                'password' => Hash::make('j@j.com'),
                'type' => 'client',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
};
