<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Order;
use App\Models\Backend\OrderDetail;
use App\Models\Backend\Product;
use App\Models\Backend\Subcategory;
use App\Models\Backend\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Laravel\Ui\Presets\React;

class HomeController extends FrontendBaseController
{
    function index()
    {
        $data['hot_products'] = Product::where('status', 1)->where('hot_key', 1)->get();
        return view($this->__LoadDataToView('frontend.home'), compact('data'));
    }
    function subcategory($slug)
    {
        $data['subcategory'] = Subcategory::where('slug', $slug)->first();
        return view($this->__LoadDataToView('frontend.subcategory'), compact('data'));
    }
    function product($slug)
    {
        // $data['carts'] = Cart::content()->count();
        $data['product'] = Product::where('slug', $slug)->first();
        return view($this->__LoadDataToView('frontend.product'), compact('data'));
    }
    function tag($slug)
    {
        $data['categories'] = Category::where('status', 1)->get();
        $data['tag'] = Tag::where('slug', $slug)->first();
        return view($this->__LoadDataToView('frontend.tag'), compact('data'));
    }
    function addToCart(Request $request)
    {
        Cart::add(
            [
                'id' => $request->input('product_id'),
                'name' => $request->input('name'),
                'qty' => $request->input('qty'),
                'price' => $request->input('price'),
                'weight' => $request->input('weight'),
                'options' => $request->options
            ]
        );
        request()->session()->flash('success', "Item added to cart Successfully");
        return redirect()->route('frontend.product', $request->slug);
    }
    function cartList()
    {
        return view($this->__LoadDataToView('frontend.cart'));
    }
    function updateCart(Request $request)
    {
        $row_ids = $request->input('row_id');
        $qtys = $request->input('qty');
        for ($i = 0; $i < count($row_ids); $i++) {
            Cart::update($row_ids[$i], $qtys[$i]);
        }
        request()->session()->flash('success', 'Cart Upadate successfully');
        return redirect()->route('frontend.cart.list');
    }
    function checkout()
    {
        return view($this->__LoadDataToView('frontend.checkout'));
    }
    function doCheckout(Request $request)
    {
        try {
            $order_data = [
                'customer_id' => auth()->user()->id,
                'order_code' => uniqid(),
                'order_date' => Carbon::now(),
                'shipping_address' => $request->shipping_address,
                'phone' => $request->phone,
                'order_status' => 'Placed',
                'total' => Cart::total(),
                'payment_mode' => $request->payment_mode,

            ];
            $order = Order::create($order_data);
            if($order) {
                $order_detail_data['order_id']= $order->id;
                foreach (Cart::content() as $rowid=>$cart_item) {
                    $order_detail_data['product_id'] = $cart_item->id;
                    $order_detail_data['quantity'] = $cart_item->qty;
                    $order_detail_data['price'] = $cart_item->price;
                    $order_detail_data['option'] = 'test';

                    OrderDetail::create($order_detail_data);
                    Cart::remove($rowid);
                    $request->session()->flash('success', ' Order  successfully!!');
                }
            } else {
                $request->session()->flash('eror', ' order failed!!');
            }
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }
        return redirect()->route('frontend.cart.checkout');
    }
}
