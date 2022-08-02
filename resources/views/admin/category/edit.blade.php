@extends('layouts.backend_master')

@section('title')
Edit Category - {{$category->name}}
@endsection
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row d-flex justify-content-center">
        <div class="col-lg-8 mb-10 shadow-lg p-3 mb-3 bg-gray rounded">
        	<h3 style="display: inline-block; ">Edit Category</h3>
        	<a style="width: 200px; margin-left: 10px; float: right;  display: inline-block;" href="{{route('add.category')}}" type="button" class="btn btn-icon waves-effect waves-light btn-primary">
                    New Category
                </a>
        	 <a style="width: 200px; float: right; display: inline-block;" href="{{route('index.category')}}" type="button" class="btn btn-icon waves-effect waves-light btn-primary">
                    Manage Category
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
            <form method="post" role="form" action="{{url('/update-category',$category->id)}}" enctype="multipart/form-data">
              @csrf
			  <div class="form-group">
			  	<div class="row">
			  		<div class="col-lg-4 mb-4">
			  			<label style="margin-top: 10px;" for="exampleInputEmail1">Category Name</label>
			  		</div>
			  		<div class="col-lg-8 mb-8">
			  			<input required type="text" value="{{$category->name}}" name="name" id="name" class="form-control">
			  		</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<div class="row">
			  		<div class="col-lg-4 mb-4">
			  			<label style="margin-top: 10px;" for="exampleInputEmail1">Category Description</label>
			  		</div>
			  		<div class="col-lg-8 mb-8">
			  			<textarea required name="description" id="description" class="form-control">{{$category->description}}</textarea>
			  		</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<div class="row">
			  		<div class="col-lg-4 mb-4">
			  			<label style="margin-top: 10px;" for="exampleInputEmail1">Category Status</label>
			  		</div>
			  		<div class="col-lg-8 mb-8">
			  			<select class="form-select" name="cat_status" id="cat_status" required style="width: 100%;">
						  <option @if($category->cat_status=='') {{"Selected"}} @endif >Select Category Status</option>
						  <option @if($category->cat_status==1) {{"Selected"}} @endif value="1">Publish</option>
						  <option @if($category->cat_status==0) {{"Selected"}} @endif value="0">Unpublish</option>
						</select>
			  		</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<div class="row">
			  		<div class="col-lg-4 mb-4">
			  			<label style="margin-top: 10px;" for="exampleInputEmail1">Category Image</label>
			  		</div>
			  		<div class="col-lg-8 mb-8">
			  			<img width="60" id="photo" src="{{asset('')}}category/{{$category->image}}"/>
			  			<input onchange="readUrl(this);" accept="image/*" type="file" class="form-control" id="image"  name="image">
			  		</div>
			  	</div>
			  </div>
			  <button style="float: right;" type="submit"  class="btn btn-primary">Update Category</button>
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
@endsection