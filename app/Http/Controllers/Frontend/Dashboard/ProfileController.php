<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Utils\ImageMasnager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    
    public function index(){
        $posts= auth()->user()->posts()->active()->with('images')->latest()->get();
        return view("frontend.dashboard.profile",compact("posts"));
    }
    public function storePost(PostRequest $request){
        $request->validated();
        try {
            DB::beginTransaction();
        // if condetion if{ comment_able = on } make it {comment_able = 1}
        $this->commendAble($request);
        // add user id to request
        $request->merge(['user_id'=>auth()->id()]);
        $post=auth()->user()->posts()->create($request->except('images'));
        
        ImageMasnager::uploadImages($request, $post);
        Db::commit();
        Cache::forget('read_more_posts');
        Cache::forget('latest_posts');

    } 
    catch (\Exception $e) {
        Db::rollback();
        return redirect()->back()->with('error', $e->getMessage());
    }
       session()->flash('success','post successfuly');
            return redirect()->back();

    }
    public function deletePost(Request $request){
        $post=Post::where('slug',$request->slug)->first();
        if(!$post){
            abort(404);
        }
       ImageMasnager::deleteImage($post);
        $post->delete();
        return redirect()->back()->with('success','Post deleted successfuly!');
    }
    public function editPost($slug){
        
    }
    public function getComment($id){
        $comments=Comment::with(['user'])->where('post_id',$id)->get();
        if(!$comments){
            return response()->json([
                'data'=>null,
                'msg'=> 'no comments',
            ]);
        }
        return response()->json([
            'data'=>$comments,
            'msg'=> 'contain comments',
        ]);   
    }
    public function showEditPost($slug){
        $post=Post::with('images')->whereSlug( $slug )->first();
        if(!$post){
            abort(404);
        }
        return view('frontend.dashboard.edit-post',compact('post'));
    }
    public function updatePost(PostRequest $request){
        $request->validated();
        try{
            DB::beginTransaction();
            $post=Post::findOrFail($request->post_id);
            $this->commendAble($request);
            $post->update($request->except(['images','_token','_method']));
    
            //check if has old images or not
            if($request->hasFile('images')){
    
                //delete old images
               ImageMasnager::deleteImage($post);
                //store new image
                ImageMasnager::uploadImages($request,$post);
                DB::commit();
            }
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->route('frontend.dashboard.profile')->with('success','Post Updated Successfully');
    }
    private function commendAble($request){
        return $request->comment_able=='on' ?
                $request->merge(['comment_able'=>1]) :
                $request->merge(['comment_able'=> 0]);

    }
    public function deletePostImage(Request $request){
        $image=Image::find($request->key);
        if(!$image){
            return response()->json([
                'status'=>'201',
                'msg'=> 'Image Not Found',
            ]);
        }

            ImageMasnager::deletImageFromLocal($image->path);
        $image->delete();
        
        return response()->json([
            'status'=> '200',
            'msg'=> 'image deleted successfully',
        ]);
    }
}
