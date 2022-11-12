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
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('plan_id')->nullable()->constrained('plans');
            $table->string('tipo')->comment('pagamento|renovacao');
            $table->double('valor');
            $table->string('meioPagamento')->nullable();
            $table->string('ticket')->nullable();
            $table->string('status')->default('pendente');
            $table->timestamp('dataConfirmacao')->nullable();
            $table->longText('obs')->nullable();
            $table->longText('json')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('forwardingTransaction_id')->nullable();
            $table->decimal('quantity');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('purchases');
    }
};
