<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Relatedsite;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
    {   //share related sites
        $relatedsites=Relatedsite::select('name','url')->get();
            //share categories
            $categories=Category::select('id','name','slug')->get();
            //store last posts in cache 
            









        view()->share([
            "relatedsites"=> $relatedsites,
            "categories"=> $categories,
           
        ]);
    }
}
