<?php

namespace App\Http\Controllers;
use App\Http\Middleware\Auth;
use App\Models\Category;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\OrderDetails;
use PDF;

use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function order_manage_view(){

        $orders = Order::all();

        return view('admin.oder.manage_order',compact('orders'));
    }

    public function order_details($id){

        $order = Order::where('id',$id)
                        ->first();

        $customer = Customer::where('id',$order->customer_id)
                        ->first();

        $shippingaddress = Shipping::where('id',$order->shipping_id)
                        ->first();

        $orderDetails = OrderDetails::where('order_id',$order->id)
                        ->get();


        return view('admin.oder.oder_details',compact('order','customer','shippingaddress','orderDetails'));

    }

    public function order_invoice_view($id){

        $order = Order::where('id',$id)
                        ->first();

        $customer = Customer::where('id',$order->customer_id)
                        ->first();

        $shippingaddress = Shipping::where('id',$order->shipping_id)
                        ->first();

        $orderDetails = OrderDetails::where('order_id',$order->id)
                        ->get();


        return view('admin.oder.oder_invoice',compact('order','customer','shippingaddress','orderDetails'));
    }

    public function order_invoice_download($id){

        $order = Order::where('id',$id)
                        ->first();

        $customer = Customer::where('id',$order->customer_id)
                        ->first();

        $shippingaddress = Shipping::where('id',$order->shipping_id)
                        ->first();

        $orderDetails = OrderDetails::where('order_id',$order->id)
                        ->get();

        $pdf = PDF::loadView('admin.oder.oder_invoice',compact('order','customer','shippingaddress','orderDetails'));
        return $pdf->download('pdfview.pdf');

    }
}
