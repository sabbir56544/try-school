<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhibitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibitors', function (Blueprint $table) {
            $table->id();
            $table->string('exhibition_id')->unique();
            $table->integer('group');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->integer('b_date');
            $table->integer('b_month');
            $table->year('b_year');
            $table->integer('country_id');
            $table->string('school');
            $table->string('art_name');
            $table->string('media')->nullable();
            $table->string('size')->nullable();
            $table->year('year');
            $table->string('image');
            $table->string('artwork')->nullable();
            $table->string('link')->nullable();
            $table->string('payment_number')->nullable();
            $table->string('transaction_id')->nullable();
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
        Schema::dropIfExists('exhibitors');
    }
}
