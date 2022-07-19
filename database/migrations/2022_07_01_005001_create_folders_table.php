<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            //foldersテーブル設計の情報を記述
            $table->increments('id');
            $table->string('title',20);
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folders');

        Schema::table('texts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
