<?php

use App\Models\PlansModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('value');
            $table->double('quantity');
            $table->double('percentual_rendimento')->nullable();
            $table->unsignedBigInteger('coin_id')->nullable();
            // $table->integer('days');
            $table->longText('details')->nullable();
            $table->timestamps();
            $table->string('status');

            $table->foreign('coin_id')->references('id')->on('coins');
        });

        DB::table('plans')->insert([
            ['name' => 'Pack 1', 'value' => 1000, 'quantity' => 10, 'status' => 'active'],
            ['name' => 'Pack 2', 'value' => 2500, 'quantity' => 25,'status' => 'active'],
            ['name' => 'Pack 3', 'value' => 5000, 'quantity' => 50, 'status' => 'active'],
            ['name' => 'Pack 4', 'value' => 10000, 'quantity' => 100, 'status' => 'active'],
        ]);

        // $dados = [
        //     ['name' => 'Pack 1', 'value' => 1000, 'quantity' => 10, 'status' => 'active'],
        //     ['name' => 'Pack 2', 'value' => 2500, 'quantity' => 25,'status' => 'active'],
        //     ['name' => 'Pack 3', 'value' => 5000, 'quantity' => 50, 'status' => 'active'],
        //     ['name' => 'Pack 4', 'value' => 10000, 'quantity' => 100, 'status' => 'active'],
        // ];


        // PlansModel::create($dados);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
