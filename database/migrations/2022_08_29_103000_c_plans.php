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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('value');
            $table->double('quantity');
            // $table->integer('days');
            $table->longText('details')->nullable();
            $table->timestamps();
        });

        DB::table('plans')->insert([
            ['name' => 'Pack 1', 'value' => 1000, 'quantity' => 10],
            ['name' => 'Pack 2', 'value' => 2500, 'quantity' => 25],
            ['name' => 'Pack 3', 'value' => 5000, 'quantity' => 50],
            ['name' => 'Pack 4', 'value' => 10000, 'quantity' => 100],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
    }
};
