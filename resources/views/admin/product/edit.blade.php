@extends('layouts.backend_master')

@section('title')
Edit Product  - {{$product->name}}
@endsection
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row d-flex justify-content-center">
        <div class="col-lg-8 mb-10 shadow-lg p-3 mb-3 bg-gray rounded">
        	<h3 style="display: inline-block;">Add New Product</h3>
        	 <a style="width: 200px; float: right; display: inline-block;" href="{{route('index.product')}}" type="button" class="btn btn-icon waves-effect waves-light btn-primary">
                    Manage Product
                </a>
        	<hr>
        	@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form id="product_form" method="post" role="form" action="{{url('/update-product',$product->id)}}" enctype="multipart/form-data">
              @csrf
			  <div class="form-group">
			  	<div class="row">
			  		<div class="col-lg-4 mb-4">
			  			<label style="margin-top: 10px;">Product Name</label>
			  		</div>
			  		<div class="col-lg-8 mb-8">
			  			<input value="{{$product->name}}" required type="text" name="name" id="name" class="form-control">
			  		</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<div class="row">
			  		<div class="col-lg-4 mb-4">
			  			<label style="margin-top: 10px;">Product Category</label>
			  		</div>
			  		<div class="col-lg-8 mb-8">
			  			<select class="form-select" name="product_cat" id="product_cat" required style="width: 100%;">
						  <option selected>Select Product Category</option>
						  @foreach($categories as $category)
						  <option value="{{$category->id}}">{{$category->name}}</option>
						  @endforeach
						</select>
			  		</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<div class="row">
			  		<div class="col-lg-4 mb-4">
			  			<label style="margin-top: 10px;">Product Short Description</label>
			  		</div>
			  		<div class="col-lg-8 mb-8">
			  			<textarea required name="short_description" id="short_description" class="form-control">{{$product->short_description}}</textarea>
			  		</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<div class="row">
			  		<div class="col-lg-4 mb-4">
			  			<label style="margin-top: 10px;">Product Long Description</label>
			  		</div>
			  		<div class="col-lg-8 mb-8">
			  			<textarea required name="long_description" id="long_description" class="form-control">{{$product->long_description}}</textarea>
			  		</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<div class="row">
			  		<div class="col-lg-4 mb-4">
			  			<label style="margin-top: 10px;">Product Regular Price</label>
			  		</div>
			  		<div class="col-lg-8 mb-8">
			  			<input value="{{$product->reguler_price}}" required type="number" name="reguler_price" id="reguler_price" class="form-control">
			  		</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<div class="row">
			  		<div class="col-lg-4 mb-4">
			  			<label style="margin-top: 10px;">Product Sale Price</label>
			  		</div>
			  		<div class="col-lg-8 mb-8">
			  			<input value="{{$product->sale_price}}" required type="number" name="sale_price" id="sale_price" class="form-control">
			  		</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<div class="row">
			  		<div class="col-lg-4 mb-4">
			  			<label style="margin-top: 10px;">Product Status</label>
			  		</div>
			  		<div class="col-lg-8 mb-8">
			  			<select class="form-select" name="product_status" id="product_status" required style="width: 100%;">
						  <option @if($product->product_status=='') {{"Selected"}} @endif >Select Product Status</option>
						  <option @if($product->product_status==1) {{"Selected"}} @endif value="1">Publish</option>
						  <option @if($product->product_status==0) {{"Selected"}} @endif value="0">Unpublish</option>
						</select>
			  		</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<div class="row">
			  		<div class="col-lg-4 mb-4">
			  			<label style="margin-top: 10px;">Product Image</label>
			  		</div>
			  		<div class="col-lg-8 mb-8">
			  			<img width="60" id="photo" src="{{asset('')}}product/{{$product->image}}"/>
			  			<input onchange="readUrl(this);" accept="image/*" type="file" class="form-control" id="image"  name="image">
			  		</div>
			  	</div>
			  </div>
			  <button style="float: right;" type="submit" class="btn btn-primary">Update Product</button>
			</form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection

@section('css')
<!-- Custom fonts for this template-->
<link href="{{asset('')}}backend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
<!-- Custom styles for this template-->
<link href="{{asset('')}}backend/css/sb-admin-2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
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

     document.forms['product_form'].elements['product_cat'].value={{$product->product_cat}};
</script>
@endsection