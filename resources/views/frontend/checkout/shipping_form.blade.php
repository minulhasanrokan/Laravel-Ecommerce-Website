@extends('layouts.frontend_master')

@section('title')
Shipping Information
@endsection

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header  mb-3 text-center text-warning">
                        Dear <strong>{{$singleCustomer->first_name}} {{$singleCustomer->last_name}}<content></content></strong>  .You have to give us product shipping info to complete your valuable order.if your billing info are same then just press on save shipping info button
                    </div>
                </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto mb-5 ">
            <div class="card">
                <div class="card-header">
                   Shipping info goes here...
                </div>
                @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
                <div class="card-body">
                    <form action="{{route('shipping.info.save')}}" method="post" >
                        @csrf
                       
                        <div class="form-group">
                            <input id="full_name" class="form-control" type="text" name="full_name"
                                value="{{$singleCustomer->first_name}} {{$singleCustomer->last_name}}" placeholder="Enter your Full Name" >
                        </div>
                        <div class="form-group">
                            <input id="email_address" class="form-control" type="text" name="email_address"
                                value="{{$singleCustomer->email_address}}" placeholder="Enter Your Email">
                        </div>
                        <div class="form-group">
                            <input id="phone_number" class="form-control" type="text" name="phone_number"
                                value="{{$singleCustomer->phone_number}}" placeholder="Enter Your Phone Number">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="address" id="address" cols="30"
                                rows="2" placeholder="Enter Your full address ">{{$singleCustomer->address}}</textarea>
                        </div>
                        <input class="btn btn-success btn-lg btn-block" type="submit" value="Save shipping info">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
