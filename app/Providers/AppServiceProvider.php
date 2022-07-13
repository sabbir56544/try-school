<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Notify;
use App;
// use App\Models\Language;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($settings){


                $gs = DB::table('general_settings')->find(1);
                // $ps = DB::table('pagesettings')->find(1);
                $seo = DB::table('seo_tools')->find(1);


                // $curr = DB::table('currencies')->where('register_id',0)->where('is_default',1)->first();
                // MAIN LANGUAGE SECTION

                if (\Request::is('admin') || \Request::is('admin/*')) {
                    $data = DB::table('admin_languages')->where('register_id',0)->where('is_default','=',1)->first();
                    App::setlocale($data->name);
                }
                else {
                    if (Session::has('language')) {
                        $data = DB::table('languages')->where('register_id',0)->find(Session::get('language'));
                        App::setlocale($data->name);
                    }
                    else {
                        $data = DB::table('languages')->where('register_id',0)->where('is_default','=',1)->first();
                        App::setlocale($data->name);
                    }
                }



                $settings->with('gs', $gs);
                // $settings->with('ps', $ps);
                $settings->with('seo', $seo);
                // $settings->with('curr', $curr);

        });

        // $cl = Language::where('is_default', 1)->first();
        // View::share('cl', $cl);
    }
}