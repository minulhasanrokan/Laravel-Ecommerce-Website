 @extends('layouts.backend_master')

@section('title')
order Details
@endsection
@section('content')




<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto mb-4">
                <h2 class="text-center">Order info for this order</h2>
            <table class="table table-hover table-bordered ">
                    <tr>
                        <th>Order No</th>
                        <td>{{$order->id}}</td>
                    </tr>
                    <tr>
                        <th>Ordet Total </th>
                        <td>{{$order->total_price}}</td>
                    </tr>
                    <tr>
                        <th>Order Status  </th>
                        <td>{{$order->order_status}}</td>
                    </tr>
                    <tr>
                        <th>Payment Status  </th>
                        <td>{{$order->payment_status}}</td>
                    </tr>
                    <tr>
                        <th>Payment type  </th>
                        <td>{{$order->payment_type}}</td>
                    </tr>
                    <tr>
                        <th>Order Date </th>
                        <td>{{$order->created_at}}</td>
                    </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto mb-4">
                <h2 class="text-center">Customer info for this order</h2>
            <table class="table table-hover table-bordered ">
                    <tr>
                        <th>Customer Name </th>
                        <td>{{$customer->first_name}} {{$customer->last_name}}</td>
                    </tr>
                    <tr>
                        <th>Phone Number </th>
                        <td>{{$customer->phone_number}}</td>
                    </tr>
                    <tr>
                        <th>Email Address </th>
                        <td>{{$customer->email_address }}</td>
                    </tr>
                    <tr>
                        <th>Address </th>
                        <td>{{$customer->address}}</td>
                    </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto mb-4">
                <h2 class="text-center">Shipping info for this order</h2>
            <table class="table table-hover table-bordered ">
                    <tr>
                        <th>Full Name </th>
                        <td>{{$shippingaddress->full_name}}</td>
                    </tr>
                    <tr>
                        <th>Phone Number </th>
                        <td>{{$shippingaddress->phone_number }}</td>
                    </tr>
                    <tr>
                        <th>Email Address </th>
                        <td>{{$shippingaddress->email_address }}</td>
                    </tr>
                    <tr>
                        <th>Address </th>
                        <td>{{$shippingaddress->address }}</td>
                    </tr>
            </table>
        </div>
    </div>
    <div class="row">
            <div class="col-md-12 mb-5">
                    <h2 class="text-center">Product info for this order</h2>
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

</div>


@endsection

@section('css')
<!-- Custom fonts for this template-->
<link href="{{asset('')}}backend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
<!-- Custom styles for this template-->
<link href="{{asset('')}}backend/css/sb-admin-2.min.css" rel="stylesheet">
@endsection

@section('js')
<!-- Bootstrap core JavaScript-->
<script src="{{asset('')}}backend/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('')}}backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('')}}backend/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('')}}backend/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="{{asset('')}}backend/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{asset('')}}backend/js/demo/chart-area-demo.js"></script>
<script src="{{asset('')}}backend/js/demo/chart-pie-demo.js"></script>
<script type="text/javascript">
    function readUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#photo').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script type="text/javascript">
        $(document).on('click','.change_product_status', function (event) {
            event.preventDefault();
            var url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'This Product and it`s details will be Unpublished!',
                type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              cancelButtonText: 'Cancel',
              confirmButtonText: 'Ok!',
            }).then(function(willDelete) {
                if (willDelete) {
                    window.location.href = url;
                }
                else{
                    swal("safe data!!");
                }
            });
        });


        $(document).on('click','.delete_product', function (event) {
            event.preventDefault();
            var url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'This Product and it`s details will be Delete!',
                type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              cancelButtonText: 'Cancel',
              confirmButtonText: 'Ok!',
            }).then(function(willDelete) {
                if (willDelete) {
                    window.location.href = url;
                }
                else{
                    swal("safe data!!");
                }
            });
        });
</script>
<style type="text/css">
    .pagination-wrapper nav .flex {
        float: right !important;
    }
</style>
@endsection