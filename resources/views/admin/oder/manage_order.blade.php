 @extends('layouts.backend_master')

@section('title')
Manage Order 
@endsection
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-bordered ">
                <thead class="thead-light">
                    <tr>
                        <th>SN.</th>
                        <th>Customer Name </th>
                        <th>Total Price</th>
                        <th>Order Date </th>
                        <th>Payment Type </th>
                        <th>Payment Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->OrderrelatedCustomer->first_name}} {{$order->OrderrelatedCustomer->last_name}}</td>
                        <td>{{$order->total_price}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->payment_type}}</td>
                        <td>{{$order->order_status}}</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-info" href="{{route('order.details',$order->id)}}" title="view Order details"><i class="fas fa-info"></i></a>
                                <a class="btn btn-success" href="{{route('order.invoice.view',$order->id)}}" title="view Order Invoice"><i class="fas fa-file-invoice"></i></a>
                                <a class="btn btn-primary" href="{{route('order.invoice.download',$order->id)}}" title="Order Invoice Download"><i class="fas fa-file-download"></i></a>
                                <a class="btn btn-danger" href="" title=" Order Delete"><i class="fas fa-trash-alt"></i></a>
                                <a class="btn btn-warning" href="" title=" Order Edit"><i class="far fa-edit"></i></a>
                            </div>
                        </td>
                    </tr>   
                    @endforeach         
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('css')
<!-- Custom fonts for this template-->
<link href="backend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
<!-- Custom styles for this template-->
<link href="backend/css/sb-admin-2.min.css" rel="stylesheet">
@endsection

@section('js')
<!-- Bootstrap core JavaScript-->
<script src="backend/vendor/jquery/jquery.min.js"></script>
<script src="backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="backend/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="backend/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="backend/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="backend/js/demo/chart-area-demo.js"></script>
<script src="backend/js/demo/chart-pie-demo.js"></script>
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