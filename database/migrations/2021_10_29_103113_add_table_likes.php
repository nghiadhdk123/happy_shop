<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('likes', function (Blueprint $table) {
        //     $table->unsignedInteger('post_id');
        //     $table->unsignedInteger('user_id');
        //     $table->tinyInteger('status')->default(0);
        //     $table->tinyInteger('type_like')->default(0);
        //     $table->timestamps();
            
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
