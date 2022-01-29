<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->integer('origin_price');
            $table->integer('sale_price');
            $table->integer('quantity');
            $table->integer('sell_number')->comment('Số lượng bán')->default(0);
            $table->integer('inventory')->comment('Tồn kho');
            $table->integer('category_id');
            $table->integer('user_id');
            $table->integer('status')->default(1);
            $table->string('content_more')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
