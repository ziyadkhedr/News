<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            "search"=> ["nullable","string",'max:100'],
        ]);
        $keyword=strip_tags($request->search);
        $posts=Post::active()->where('title','like','%'. $keyword .'%')
        ->orWhere('description','like','%'. $keyword .'%')
        ->paginate(14);
        $message = null;

        if ($posts->isEmpty()) {
            $message = "there is no match.";
        }
    
        return view('frontend.search', compact('posts', 'message'));
        // return view('frontend.search',compact('posts'));
        
    }
}
