<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name','slug','status'];
    public function posts(){
        return $this->hasMany(Post::class,'category_id');
    }
    public function scopeActivecategory($query){
        return $query->where('status',1);
        
    }
}
