<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdvertTop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_top', function (Blueprint $table) {
            $table->increments('adt_id');
            $table->integer('adt_gr_id')->unsigned();
            $table->foreign('adt_gr_id')
                ->references('id')
                ->on('group_vn');
            $table->integer('adt_ad_id')->unsigned();
            $table->foreign('adt_ad_id')
                ->references('ad_id')
                ->on('adverts')
                ->onDelete('cascade');
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
        Schema::dropIfExists('advert_top');
    }
}
