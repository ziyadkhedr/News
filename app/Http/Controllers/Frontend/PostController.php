<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\NewCommentNotify;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug){
        $mainpost = Post::active()->with(['comments'=>function($query){$query->latest()->limit(3);}])->whereSlug($slug)->first();
        if (!$mainpost) {
            abort(404); // أو اعمل redirect لو حابب
        }
    
        $category=$mainpost->category;
        $posts_belonges_to_category=$category->posts()->select('id','slug','title')->limit(5)->get();
        $mainpost->increment('num_of_views');
        return view("frontend.show", compact("mainpost",'posts_belonges_to_category','category'));
    }
   
    public function getallposts($slug){
        $post=Post::active()->whereSlug($slug)->first();
        $comments=$post->comments()->with('user')->get();
        return response()->json($comments);
    }
    public function saveComments(Request $request){
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'post_id' => ['required', 'exists:posts,id'],
            'comment' => ['required', 'string', 'max:200'],
            
        ]);
        
        $comment=Comment::create([
            'user_id'=> $request->user_id,
            'comment'=> $request->comment,
            'post_id'=> $request->post_id,
            'ip_address'=> $request->ip(),
        ]);

        $post=Post::findOrFail($request->post_id);
        $post->user->notify(new NewCommentNotify($comment,$post));

        $comment->load('user');
        if(!$comment){
            return response()->json([
                'data'=>'operation filed',
                'status'=>403,
            ]);
            
        }
        return response()->json([
            'msg'=> 'comment stored sccessfuly!',
            'comment'=>$comment,
            'status'=>201,
        ]);
    }
    
    }
