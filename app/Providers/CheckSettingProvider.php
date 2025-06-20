<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Relatedsite;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CheckSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        $getsetting = Setting::firstOr(function () {
            return Setting::create([
                'site_name' => 'name',
                'email' => 'example@gmail.com',
                'favicon' => 'default',
                'logo' => '/img/logo.png',
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://www.instagram.com/',
                'X' => 'https://x.com/',
                'youtube' => 'https://www.youtube.com',
                'linkedin' => 'https://www.linkedin.com/',
                'street' => 'salah da3dor street',
                'city' => 'Baltim',
                'country' => 'Egypt',
                'phone' => "01070505688",
            ]);
        });

        view()->share([
            "getsetting" => $getsetting,
        ]);
    }
}
