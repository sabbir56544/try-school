<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable;
            $table->string('favicon');
            $table->string('title', 100);
            $table->string('header_email', 100)->nullable;
            $table->string('header_phone', 100)->nullable;
            $table->text('footer');
            $table->text('copyright');
            $table->string('colors', 150)->nullable;
            $table->tinyInteger('is_talkto')->default(1)->nullable()->unsigned();
            $table->text('talkto')->nullable();
            $table->tinyInteger('is_language')->default(1)->nullable()->unsigned();
            $table->text('map_key')->nullable();
            $table->tinyInteger('is_disqus')->default(0)->nullable()->unsigned();
            $table->text('disqus')->nullable();
            $table->tinyInteger('is_contact')->default(0)->nullable()->unsigned();
            $table->tinyInteger('is_currency')->default(1)->unsigned();
            $table->tinyInteger('currency_format')->default(0)->nullable()->unsigned();
            $table->float('withdraw_fee')->default(0)->unsigned();
            $table->float('withdraw_charge')->default(0)->unsigned();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_user')->nullable();
            $table->string('mail_pass')->nullable();
            $table->string('from_email')->nullable();
            $table->string('from_name')->nullable();
            $table->tinyInteger('is_smtp')->default(0)->unsigned();
            $table->tinyInteger('is_affiliate')->default(1)->unsigned();
            $table->integer('affiliate_charge')->default(0)->unsigned();
            $table->text('affiliate_banner');
            $table->float('percentage_commission')->default(0)->unsigned();
            $table->tinyInteger('is_verification_email')->default(0)->unsigned();
            $table->string('error_banner', 100);
            $table->tinyInteger('is_captcha')->default(0)->unsigned();
            $table->tinyInteger('is_popup')->default(0)->unsigned();
            $table->text('popup_background');
            $table->integer('popup_time')->default(0)->unsigned();
            $table->string('invoice_logo');
            $table->tinyInteger('is_secure')->default(0)->unsigned();
            $table->string('footer_logo');
            $table->string('email_encryption', 200);
            $table->tinyInteger('is_maintain')->default(0)->unsigned();
            $table->text('maintain_text')->nullable();
            $table->string('breadcrumb_banner')->nullable();
            $table->integer('register_id')->default(0)->unsigned();
            $table->string('mail_driver')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->text('deactivated_text')->nullable();
            $table->tinyInteger('is_notify_popup')->default(0)->unsigned();
            $table->integer('notify_popup_time')->default(0)->unsigned();
            $table->string('cert_sign')->nullable();
            $table->text('cert_text')->nullable();
            $table->text('youtube_api_key')->nullable();
            $table->integer('is_youtube_api')->nullable()->default(0)->unsigned();
            $table->tinyInteger('is_faq')->default(0)->unsigned();
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
        Schema::dropIfExists('general_settings');
    }
}