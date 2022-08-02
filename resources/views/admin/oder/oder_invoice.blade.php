<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-5">
                        <div class="col-md-6">
                            <img width="400" height="90" src="https://scontent.fdac138-1.fna.fbcdn.net/v/t39.30808-6/266817665_1902177089984991_448501137068382761_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeHmpvF99KCigncbtx1DdxBgLPfSqg475VAs99KqDjvlUCIOJrG0GwvYPwdU2IRrYKOffnmxxJLJuahStpHyzXF0&_nc_ohc=Ikds79I6s_QAX_kh7oY&_nc_ht=scontent.fdac138-1.fna&oh=00_AT_2HGy68V_TgYtbS5dl45izHuqICPv7DbYLWOlmpipGeA&oe=62EC7684">
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">Invoice #{{$order->id}}</p>
                            <p class="text-muted">Order Date: {{$order->created_at}}</p>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Client Information</p>
                            <p class="mb-1">{{$customer->first_name}} {{$customer->last_name}}</p>
                            <p>{{$customer->phone_number}}</p>
                            <p class="mb-1">{{$customer->email_address }}</p>
                            <p class="mb-1">{{$customer->address}}</p>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4">Shipping Information</p>
                            <p class="mb-1"><span class="text-muted">Full Name: </span> {{$shippingaddress->full_name }}</p>
                            <p class="mb-1"><span class="text-muted">Phone Number: </span> {{$shippingaddress->phone_number }}</p>
                            <p class="mb-1"><span class="text-muted">Email: </span> {{$shippingaddress->email_address }}</p>
                            <p class="mb-1"><span class="text-muted">Address: </span> {{$shippingaddress->address }}</p>
                        </div>
                    </div>

                    <div class="row p-5">
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered ">
			                    <thead class="thead-light">
			                        <tr>
			                            <th>SN.</th>
			                            <th>Product Id</th>
			                            <th>Product Image</th>
			                            <th>Product Name</th>
			                            <th>Product Price</th>
			                            <th>Product Quantity</th>
			                            <th>Total Price</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                        @php
			                        $sl =1;
			                        @endphp
			                        @foreach($orderDetails as $details)
			                            <tr>
			                                <td>{{$sl}}</td>
			                                <td>{{$details->id}}</td>
			                                <td><img width="60" src="{{asset('')}}product/{{$details->product_image}}" /></td>
			                                <td>{{$details->product_name}}</td>
			                                <td>{{$details->product_price}}</td>
			                                <td>{{$details->product_qty}}</td>
			                                <td>{{$details->product_price*$details->product_qty}}</td>
			                            </tr>
			                            @php
			                            $sl ++;
			                            @endphp
			                            @endforeach
			                    </tbody>
			                </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light">{{$order->total_price}}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Discount</div>
                            <div class="h2 font-weight-light">0%</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Sub - Total amount</div>
                            <div class="h2 font-weight-light">{{$order->total_price}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank" href="http://totoprayogo.com">totoprayogo.com</a></div>

</div>


