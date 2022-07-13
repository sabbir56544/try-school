<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('rtl')->default(0)->unsigned();
            $table->tinyInteger('is_default')->default(0)->unsigned();
            $table->string('language', 100)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('file', 100)->nullable();
            $table->integer('register_id')->default(0)->unsigned();
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
        Schema::dropIfExists('languages');
    }
}