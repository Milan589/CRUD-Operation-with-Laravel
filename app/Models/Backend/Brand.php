<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table='brands';
    protected $fillable = ['title','slug','rank','image','meta_title','meta_keyword','meta_description',' status','created_by','updated_by','deleted_at','created_at','updated_at'];
}
