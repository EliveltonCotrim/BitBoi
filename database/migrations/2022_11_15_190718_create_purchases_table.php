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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_user_id')->constrained('users');
            $table->integer('quantity_coin');
            $table->double('value_coin');
            $table->double('value_total');
            $table->double('valor_multa')->nullable();
            $table->double('valor_recebido')->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->unsignedBigInteger('coin_id')->nullable();
            $table->double('percentual_rendimento');
            $table->integer('time_pri');
            $table->date('dt_purchase')->nullable();
            $table->date('dt_encerramento')->nullable();
            $table->string('status');

            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('plans');
            $table->foreign('coin_id')->references('id')->on('coins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
};
