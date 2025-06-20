<?php
namespace App\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageMasnager{

public static function uploadImages($request,$post=null,$user=null){
    if($request->hasFile('images')){
        foreach($request->images as $image){
            $filename=self::generateImageName($image) ;
            $path= self::storeImageInLocal($image,'posts', $filename);

            $post->images()->create([
                'path'=> $path,
            ]);
        }
        
    }
    if($request->hasFile('image')){
        //delete image from local
        $image = $request->file('image');
        self::deletImageFromLocal($user->image) ;
        //store new image in local
        $filename=self::generateImageName($image) ;
        $path= self::storeImageInLocal($image,'users', $filename);

        $user->update(['image'=>$path]);

    }  
}
public static function deleteImage($post){
    if($post->images()->count()>0){
        foreach($post->images as $image){
            self::deletImageFromLocal($image->path) ;
            $image->delete();
        }
    }
} 
private static function generateImageName($image){
    $file = Str::uuid() . time().'.'. $image->getClientOriginalExtension();
    return $file;

}
public static function deletImageFromLocal($image){
    if(File::exists(public_path($image))){
        File::delete(public_path($image));
    }
}
private static function storeImageInLocal($image,$path, $filename){
    $path=$image->storeAs('uploads/'.$path, $filename,['disk'=> 'uploads']); 
    return $path;
}



}