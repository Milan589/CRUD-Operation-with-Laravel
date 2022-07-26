<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Order;
use App\Models\Backend\OrderDetail;
use App\Models\Backend\Product;
use App\Models\Backend\Subcategory;
use App\Models\Backend\Tag;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Laravel\Ui\Presets\React;
use Omnipay\Omnipay;

class HomeController extends FrontendBaseController
{
    private $gateway;

    public function __construct()
    {
        Cart::setGlobalTax(0);
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }

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
        $options =[];
        if(!empty($request->options)){
            $options = $request->options;
        }
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
            if ($order) {
                $to =0;
                $order_detail_data['order_id'] = $order->id;
                foreach (Cart::content() as $rowid => $cart_item) {
                    $order_detail_data['product_id'] = $cart_item->id;
                    $order_detail_data['quantity'] = $cart_item->qty;
                    $order_detail_data['price'] = $cart_item->price;
                    $order_detail_data['option'] = 'test';

                    OrderDetail::create($order_detail_data);   
                    $to = $to + ($cart_item->qty*$cart_item->price);
                    // Cart::remove($rowid);
                    $request->session()->flash('success', ' Order  successfully!!');
                }
                if($request->payment_mode == 'online'){
                    Session:: put('order_id',$order->id);
                    $response = $this->gateway->purchase(array(
                        'amount' =>round($to),
                        'currency' => env('PAYPAL_CURRENCY'),
                        'returnUrl' => url('success'),
                        'cancelUrl' => url('error'),
                    ))->send();
    
                    if ($response->isRedirect()) {
                        $response->redirect(); // this will automatically forward the customer
                    } else {
                        // not successful
                        return $response->getMessage();
                    }
                }     
            } else {
                $request->session()->flash('error', ' order failed!!');
            }
        } catch (\Exception $exception) {
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
        }
        return redirect()->route('frontend.checkout');
    }
    public function success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                // The customer has successfully paid.
                $arr_body = $response->getData();

                // Insert transaction data into the database
                $payment = new Payment();
                $payment->order_id = Session:: get('order_id');
                $payment->payment_id = $arr_body['id'];
                $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr_body['state'];
                $payment->save();

                Session::flash('success','Payment is successful. Your transaction id is: ' . $arr_body['id']);
            } else {
                return $response->getMessage();
            }
        } else {
            Session::flash('erroe','Transaction is declined');
        }
        return redirect()->route('frontend.checkout');
    }

    /**
     * Error Handling.
     */
    public function error()
    {
        Session::flash('User cancelled the payment.');
    }
}
