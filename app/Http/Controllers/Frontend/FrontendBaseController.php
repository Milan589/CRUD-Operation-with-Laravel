<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class FrontendBaseController extends Controller
{
    function __LoadDataToView($viewPath){
        view()->composer($viewPath, function($view){
           $carts = Cart::content();
           $categories = Category::where('status',1)->get();
            $view->with('menu_categories',$categories);
            $view->with('carts',$carts);

        });
        return $viewPath;
    }
}
