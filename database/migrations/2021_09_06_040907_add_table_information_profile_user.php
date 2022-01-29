<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableInformationProfileUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinfor', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('email_2')->unique()->nullable();
            $table->string('nickname')->nullable();
            $table->string('hobby')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_instargram')->nullable();
            $table->string('lover')->nullable();
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
        Schema::dropIfExists('userinfor');
    }
}
