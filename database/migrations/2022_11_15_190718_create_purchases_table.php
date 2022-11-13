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
            $table->double('quantity');
            $table->double('value_coin');
            $table->double('value_total');
            $table->foreignId('plan_id')->constrained('plans')->nullable();;
            $table->foreignId('coin_id')->constrained('coins')->nullable();;
            $table->double('percentual_rendimento');
            $table->date('dt_purchase')->nullable();
            $table->string('status');

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
        Schema::dropIfExists('purchases');
    }
};
