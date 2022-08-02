<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Models\Customer;
use App\Models\Shipping;
use Illuminate\Http\Request;
Use App\Mail\CustomerSendMail;
Use App\Models\Order;
Use App\Models\OrderDetails;
use Session;
use Cart;

use DB;

class CheckoutController extends Controller
{
    //

    public function coustomer_checkout_form(){

        return view("frontend.checkout.customer_form");
    }

    public function customer_register(Request $request){

        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email_address' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:customers'],
            'password' => 'required',
            'address' => 'required'
        ]);

        $data = array();

        $data['first_name']=$request->first_name;
        $data['last_name']=$request->last_name;
        $data['email_address']=$request->email_address;
        $data['phone_number']=$request->phone_number;
        $data['password']=bcrypt($request->password);
        $data['address']=$request->address;

        $name = $request->first_name." ".$request->last_name;

        $customerUrl = $this->createSlug($name);

        $data['customer_url']=$customerUrl;

        $customer = DB::table('customers')->insert($data);

        $id = DB::getPdo()->lastInsertId();

        $CustomerId =  $id;

        $singleCustomer = Customer::where('id',$CustomerId)
                        ->where('status',1)
                        ->where('customer_status',1)
                        ->first();

        Session::put(['customer_id'=>$singleCustomer->id]);
        Session::put(['customer_email'=>$singleCustomer->email_address]);
        Session::put(['status'=>$singleCustomer->status]);
        Session::put(['customer_status'=>$singleCustomer->customer_status]);

        //Mail::to($request->user())->send(new CustomerSendMail($customer));

        return redirect('/checkout-shipping');

    }

    public function checkout_shipping_form(){

        $singleCustomer = Customer::where('id',Session::get('customer_id'))
                        ->where('status',Session::get('status'))
                        ->where('customer_status',Session::get('customer_status'))
                        ->first();

        return view('frontend.checkout.shipping_form',compact('singleCustomer'));
    }

    public function shipping_info_save(Request $request){

        $validated = $request->validate([
            'full_name' => 'required|max:255',
            'email_address' => ['required', 'email', 'max:255', 'unique:shippings'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:shippings'],
            'address' => 'required'
        ]);
        $data = array();

        $data['full_name']=$request->full_name;
        $data['email_address']=$request->email_address;
        $data['phone_number']=$request->phone_number;
        $data['address']=$request->address;

        $singleCustomer = Customer::where('id',Session::get('customer_id'))
                        ->where('status',Session::get('status'))
                        ->where('customer_status',Session::get('customer_status'))
                        ->first();

        $data['customer_id']=$singleCustomer->id;


        $customerShipping = DB::table('shippings')->insert($data);

        $id = DB::getPdo()->lastInsertId();

        $shippingId =  $id;

        Session::put(['shipping_id'=>$shippingId]);

        return redirect('/make-payment');
        
    }

    public function make_payment(){

        $singleCustomer = Customer::where('id',Session::get('customer_id'))
                    ->where('status',Session::get('status'))
                    ->where('customer_status',Session::get('customer_status'))
                    ->first();


        return view('frontend.checkout.payment',compact('singleCustomer'));
    }

    public function new_order(Request $request){
        //return $request->all();

            $order = new Order;

            $orderDetails = new OrderDetails;
            
            $order->customer_id = Session::get('customer_id');
            $order->shipping_id = Session::get('shipping_id');
            $order->total_price = Cart::getSubTotal();
            $order->payment_type = $request->payment_type;

            $order->save();

            $orderId = DB::getPdo()->lastInsertId();

            $cartContent = Cart::getContent();

            foreach ($cartContent as $content) {
                
                $orderDetails->order_id = $orderId;
                $orderDetails->product_id = $content->id;
                $orderDetails->product_name =  $content->name;
                $orderDetails->product_image =  $content->attributes->image;
                $orderDetails->product_price =  $content->price;
                $orderDetails->product_qty =  $content->quantity;

                $orderDetails->save();
            }

            Cart::clear();

            return redirect('/');

    }

    public function createSlug($title, $id = 0)
    {

        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Customer::select('customer_url')->where('customer_url', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

    public function logout_customer(){

        session()->forget(['customer_id']);
       return redirect('/'); 
    }

 
}
