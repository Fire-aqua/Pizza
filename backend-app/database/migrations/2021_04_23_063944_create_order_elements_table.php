<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_elements', function (Blueprint $table) {
            $table->id();
            $table->integer('count');
            $table->string('size');
            $table->integer('price');
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('good_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('order_elements');
    }
}
