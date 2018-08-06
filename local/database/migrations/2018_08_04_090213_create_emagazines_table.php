<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmagazinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emagazines', function (Blueprint $table) {
            $table->increments('e_id');
            $table->string('e_title');
            $table->string('e_img');
            $table->string('e_summary');
            $table->string('e_title_meta');
            $table->string('e_keyword_meta');
            $table->string('e_detail');
            $table->integer('e_view');
            $table->integer('e_acc_id')->unsigned();
            $table->foreign('e_acc_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');
            $table->tinyInteger('e_hot');
            $table->tinyInteger('e_status');
            
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
        Schema::dropIfExists('emagazines');
    }
}
