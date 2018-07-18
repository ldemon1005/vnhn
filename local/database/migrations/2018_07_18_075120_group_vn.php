<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupVn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_vn', function (Blueprint $table) {
            $table->increments('id');
            $table->string('parentid')->default(null);
            $table->string('title')->default(null);
            $table->string('link')->default(null);
            $table->string('summary')->default(null);
            $table->integer('status')->default(null);
            $table->integer('idx')->default(null);
            $table->integer('kind')->default(null);
            $table->integer('inquiry')->default(null);
            $table->integer('home')->default(null);
            $table->integer('members')->default(null);
            $table->string('fimages')->default(null);
            $table->string('keywords')->default(null);
            $table->string('description')->default(null);
            $table->string('titlemeta')->default(null);
            $table->string('created')->default(null);
            $table->string('shortlink')->default(null);
            $table->string('avatar')->default(null);
            $table->string('slug')->default(null);
            $table->integer('created_at')->default(null);
            $table->integer('updated_at')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_vn');
    }
}
