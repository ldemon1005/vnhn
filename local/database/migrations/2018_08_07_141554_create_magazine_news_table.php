<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagazineNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazine_news', function (Blueprint $table) {
            $table->increments('m_id');
            $table->string('m_title');
            $table->string('m_img');
            $table->integer('m_acc_id')->unsigned();
            $table->foreign('m_acc_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');
            $table->tinyInteger('m_hot');
            $table->tinyInteger('m_status');
            $table->integer('created_at');
            $table->integer('updated_at');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magazine_news');
    }
}
