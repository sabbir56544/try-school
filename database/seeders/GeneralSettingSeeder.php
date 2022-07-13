<?php

namespace Database\Seeders;

use App\Models\Settings\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSetting::create([
            'logo' => '1645717630gainsschool.png',
            'favicon' => '1596869104lms.png',
            'title' => 'Gains School',
            'header_email' => 'smtp',
            'header_phone' => '0123 456789',
            'footer' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae',
            'copyright' => 'COPYRIGHT © 2021. All Rights Reserved By <b>Gains Group</b>',
            'colors' => '#53BC1C',
            'is_talkto' => '0',
            'is_language' => '1',
            'map_key' => 'AIzaSyB1GpE4qeoJ__70UZxvX9CTMUTZRZNHcu8',
            'is_disqus' => '0',
            'is_contact' => '1',
            'currency_format' => '0',
            'withdraw_fee' => '0',
            'withdraw_charge' => '3',
            'mail_host' => 'smtp.mandrillapp.com',
            'mail_port' => '587',
            'mail_user' => 'Winarz',
            'mail_pass' => 'txlJtoTsJKGI6r0RMrMcJw',
            'from_email' => 'winarz@academyzpresso.app',
            'from_name' => 'AcademyZPresso',
            'is_smtp' => '1',
            'is_currency' => '1',
            'is_affiliate' => '1',
            'affiliate_charge' => '8',
            'affiliate_banner' => '15587771131554048228onepiece.jpeg',
            'percentage_commission' => '30',
            'is_verification_email' => '0',
            'is_captcha' => '0',
            'error_banner' => '1601801226error-banner.jpg',
            'is_popup' => '1',
            'popup_background' => 'null',
            'popup_time' => '0',
            'invoice_logo' => '1645717635gainsschool.png',
            'is_secure' => '0',
            'footer_logo' => '1645717634gainsschool.png',
            'email_encryption' => 'null',
            'is_maintain' => '0',
            'maintain_text' => '0',
            'breadcrumb_banner' => '16202753561599670334bigbanner.jpg',
            'register_id' => '0',
            'mail_driver' => 'smtp',
            'mail_encryption' => 'TLS',
            'is_notify_popup' => '0',
            'notify_popup_time' => '0',
            'cert_sign' => '1601963396sign.png',
            'cert_text' => 'This is to certify that {student_name} has successfully completed the {course_title} course in {website_title}.',
            'youtube_api_key' => 'AIzaSyBM9KfqFsOzI7x2gRSLBk9PV-XAPyQDZtY',
            'is_youtube_api' => '0',
            'is_faq' => '1',
        ]);
    }
}