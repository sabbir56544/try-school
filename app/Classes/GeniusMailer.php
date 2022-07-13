<?php

namespace App\Classes;

use App\Models\Settings\GeneralSetting;
use DB;
use Config;

class GeniusMailer
{
    public function __construct()
    {
        $gs = GeneralSetting::findOrFail(1);
    }
}