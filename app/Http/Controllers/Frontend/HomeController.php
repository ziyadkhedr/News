<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $posts=Post::active()->with('images')->latest()->paginate(9);
        $top_3_posts=Post::active()->orderBy('num_of_views','desc')->limit(3)->get();
        $oldest_3_posts=Post::active()->oldest()->take(3)->get();
        $top_3_comments=Post::active()->withCount('comments')->orderBy('comments_count','desc')->take(3)->get();
        $categories=Category::all();
        $categories_with_posts=$categories->map(function($category){
            $category->posts=$category->posts()->limit(4)->get();
            return $category;
        });
        return view('frontend.index',compact('posts','top_3_posts','oldest_3_posts','top_3_comments','categories_with_posts'));
    }
}
