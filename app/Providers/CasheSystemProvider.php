<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CasheSystemProvider extends ServiceProvider
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
        //read_more_posts
        if(!Cache::has("read_more_posts")){
            $read_more_posts=Post::select('id','title','slug')->latest()->limit(10)->get();
            Cache::remember('read_more_posts',3600, function () use ($read_more_posts){
                return $read_more_posts;
            });
        }
        //latest_posts
        if(!Cache::has('latest_posts')){
            $latest_posts=Post::select('id','slug','title')->limit(5)->get();
                Cache::remember('latest_posts',3600, function () use ($latest_posts){
                    return $latest_posts;
                });

            }
            

            //top_posts_comments
            if(!Cache::has('top_posts_comments')){
                $top_posts_comments=Post::withCount('comments')->orderBy('comments_count','desc')->take(5)->get();
                Cache::remember('top_posts_comments',3600, function () use ($top_posts_comments){
                    return $top_posts_comments;
                });
            }

            //get caches
            $latest_posts=Cache::get('latest_posts');
            $top_posts_comments=Cache::get('top_posts_comments');
            $read_more_posts=Cache::get('read_more_posts');
        view()->share([
            'read_more_posts'=> $read_more_posts,
            "latest_posts"=> $latest_posts,
            "top_posts_comments"=> $top_posts_comments,
        ]);
    }
}
