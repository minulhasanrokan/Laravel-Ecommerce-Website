<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Session;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //

    public function login_customer(Request $request){

        $email = $request->email_address;
        $pass = $request->password;

        $customer= Customer::where('email_address',$email)->first();

        if($customer){

            $hash = password_hash($pass, PASSWORD_DEFAULT);

            if (password_verify($customer->password, $hash)) {

                Session::put(['customer_id'=>$customer->id]);
                Session::put(['customer_email'=>$customer->email_address]);
                Session::put(['status'=>$customer->status]);
                Session::put(['customer_status'=>$customer->customer_status]);

                return redirect('/');

            } else {
                return redirect()->back();
            }
        }

    }
}
