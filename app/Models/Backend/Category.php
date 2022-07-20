<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='categories';
    protected $fillable = ['title','slug','status','rank', 'image','meta_title', 'meta_keyword','meta_description', 'created_by','updated_by'];

    function createdBy(){
        return $this->belongsTo(User::class, 'created_by','id');
    }
    function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by','id');
    }
    function subcategories(){
        return $this->hasMany(Subcategory::class,'category_id','id');
    }
    function activeSubcategories(){
        return $this->hasMany(Subcategory::class,'category_id','id')->where('status',1);
    }
}