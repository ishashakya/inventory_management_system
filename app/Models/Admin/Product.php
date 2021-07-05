<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','brand','description','image','category_id','user_id'];
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
