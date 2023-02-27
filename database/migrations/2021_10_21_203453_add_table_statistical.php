<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableStatistical extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistical', function (Blueprint $table) {
            $table->id();
            $table->string('order_date')->nullable();
            $table->string('sales')->nullable();
            $table->string('profit')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('total_order')->nullable();
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
        Schema::dropIfExists('statistical');
    }
}
