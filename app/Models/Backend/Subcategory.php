<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='subcategories';
    protected $fillable = ['category_id','title','slug','status','rank', 'image','meta_title', 'meta_keyword','meta_description', 'created_by','updated_by'];

    function createdBy(){
        return $this->belongsTo(User::class, 'created_by','id');
    }
    function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by','id');
    }
    function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    function products(){
        return $this->hasMany(Product::class,'subcategory_id','id');
    }
}