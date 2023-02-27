<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('note')->nullable();
            $table->integer('total_price')->nullable();
            $table->integer('status')->default(0)->comment('0 :Chờ xác nhận,1: Đã xác nhận,2: Đang giao hàng,3: Đã hoàn thành'); //0: Chờ xác nhận    1: Đã xác nhận      2: Đang giao hàng       3: Đã hoàn thành
            $table->integer('pay_method')->comment('Phương thức thanh toán,0 :Tiền mặt,1: Ví MoMo,2: Ví ZaloPay,3: Thẻ ATM')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
