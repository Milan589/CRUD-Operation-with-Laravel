<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends FrontendBaseController
{
    function registerForm(){
        return view($this->__LoadDataToView('frontend.customer.register'));
    }
    function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'perm_address' => 'required',
                'phone'=> 'required',
                'email'=> 'required|email',
                'password'=> 'required',
            ]
        );
          DB::beginTransaction();
        try {
            $user = User::create([
                'role_id'=> 10,
                'name'=> $request->input('name'),
                'email'=> $request->input('email'),
                'password'=> Hash::make( $request->input('password')),
            ]);
            if($user){
                $request->request->add(['user_id'=>$user->id]);
                $customer = Customer::create($request->all());  
                if($customer){
                    DB::commit();
                    $request->session()->flash('success','Your account register successfully!!');
                     return redirect()->route('frontend.customer.register');
                }else{
                    DB::rollBack();
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            $request->session()->flash('error', 'Error: ' . $exception->getMessage());
            return redirect()->route('frontend.customer.register');
        }
     }
     function home(){
        return view($this->__LoadDataToView('frontend.customer.home'));
    }
  
}
