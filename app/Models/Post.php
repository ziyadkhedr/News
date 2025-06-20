<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory,Sluggable;
    protected $fillable=['title','description','slug','num_of_views','comment_able','category_id','user_id','status'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'post_id');
    }
    public function images(){
        return $this->hasMany(Image::class,'post_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function scopeActive($query){
        $query->where('status',1);
    }
}
