 @extends('layouts.backend_master')

@section('title')
Manage Product 
@endsection
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row d-flex justify-content-center">
        	<div class="container-fluid">
        		<h3 style="display: inline-block;">Manage Product</h3>
        	 	<a style="width: 200px; float: right; display: inline-block;" href="{{route('add.product')}}" type="button" class="btn btn-icon waves-effect waves-light btn-primary">
                    Add New Product
                </a>
        	</div>
        	<div class="container-fluid">
		   		<table class="table table-bordered table-hover">
				  <thead>
				    <tr>
				      <th width="5" scope="col">Sl</th>
				      <th scope="col">Image</th>
				      <th scope="col">Name</th>
				      <th scope="col">Short Description</th>
				      <th scope="col">Category</th>
				      <th scope="col">Price</th>
				      <th scope="col">Create Date</th>
				      <th scope="col">Status</th>
				      <th width="50" scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@php
				  		$i = ($products->perPage() * ($products->currentPage() - 1)) + 1
				  	@endphp
				  	@foreach($products as $product)
				    <tr>
				      <th scope="row">{{$i}}</th>
				      <td><img width="50" height="50" src="{{asset('')}}product/{{$product->image}}"></td>
				      <td>{{$product->name}}</td>
				      <td>{{$product->short_description}}</td>
				      <td>{{$product->cat_name}}</td>
				      <td><del>{{$product->reguler_price}}</del> - {{$product->sale_price}}</td>
				      <td>{{$product->created_at}}</td>
				      <td>
				      	@if($product->product_status==1)
				      		Published
				      	@else
				      		Unpublished
				      	@endif
				      </td>
				      <td>
				      	<div class="btn-group">
						  <a href="{{route('change.product.status',$product->id)}}" class="change_product_status btn @if($product->product_status==1)
					      		btn-primary
					      	@else
					      		btn-danger
					      	@endif">
						  	@if($product->product_status==1)
					      		Unpublish
					      	@else
					      		Publish
					      	@endif
						  </a>
						  <a href="{{route('edit.product',$product->id)}}" class="btn btn-warning">Update</a>
						  <a href="{{route('delete.product',$product->id)}}" class="delete_product btn btn-danger">Delete</a>
						</div>
				      </td>
				    </tr>
				    @php
				  		$i++;
				  	@endphp
				    @endforeach
				  </tbody>
				</table>
				@if ($products->hasPages())
				    <div class="pagination-wrapper">
				         {{ $products->links() }}
				    </div>
				@endif
        	</div>
    </div>
</div>
<!-- /.container-fluid -->

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