<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Product;
use App\Models\Backend\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $data['categories'] = Category::where('status',1)->get();
        $data['hot_products'] = Product::where('status',1)->where('hot_key',1)->get();
        return view('frontend.home', compact('data'));
    }
}
