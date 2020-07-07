<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('user_img', 200);
            $table->string('title', 100);
            $table->string('content', 200);
            $table->integer('user_id')->unsigned();
            $table->string('url', 150);
            $table->boolean('seen')->default(0)->comment('0=> not seen, 1=>seen');
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
        Schema::dropIfExists('notifications');
    }
}
