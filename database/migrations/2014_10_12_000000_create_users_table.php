<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('bio')->nullable();
            $table->string('image')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('code', 100)->nullable();
            $table->unsignedBigInteger('is_verified')->nullable()->unsigned();
            $table->string('message', 255)->nullable();
            $table->string('document', 255)->nullable();
            $table->string('facebook_url', 255)->nullable();
            $table->string('twitter_url', 255)->nullable();
            $table->string('linkedin_url', 255)->nullable();
            $table->double('balance')->nullable();
            $table->string('affiliate_code', 100)->nullable();
            $table->unsignedBigInteger('referral_id')->nullable()->unsigned();
            $table->unsignedBigInteger('register_id')->nullable()->unsigned();
            $table->unsignedBigInteger('preloaded')->nullable()->unsigned();
            $table->unsignedBigInteger('is_provider')->nullable()->unsigned();
            $table->tinyInteger('status');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}