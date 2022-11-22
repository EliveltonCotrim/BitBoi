<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendimentos_pagos', function (Blueprint $table) {
            $table->id();
            $table->double('valor');
            $table->foreignId('boleto_id')->constrained('boletos');
            $table->foreignId('rendimentos_id')->constrained('rendimentos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rendimentos_pagos');
    }
};
