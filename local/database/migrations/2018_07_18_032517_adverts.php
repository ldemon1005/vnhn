<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Adverts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->increments('ad_id');
            $table->string('ad_name');
            $table->string('ad_link');
            $table->string('ad_img');
            $table->string('ad_content');
            $table->string('ad_width');
            $table->string('ad_height');
            $table->string('ad_time');
            $table->integer('ad_view')->default(0);
            $table->integer('ad_status');
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
        Schema::dropIfExists('adverts');
    }
}
