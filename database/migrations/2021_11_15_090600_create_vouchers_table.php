<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên voucher');
            $table->string('code')->comment('Mã voucher');
            $table->string('money')->comment('Giảm theo tiền')->nullable();
            $table->string('percent')->comment('Giảm theo phần trăm')->nullable();
            $table->integer('status')->default(1);
            $table->string('expiry')->comment('Hạn sử dụng');
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
        Schema::dropIfExists('vouchers');
    }
}
