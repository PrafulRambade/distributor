@extends('layouts.app')

@section('title', 'Add Distributor')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Distributor</h1>
        <a href="{{route('distributor.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Distributor Details</h6>
        </div>
        <form method="POST" action="">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    {{-- First Name --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <label>Distributor Name <span style="color:red;">*</span></label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('first_name') is-invalid @enderror" 
                            id="exampleFirstName"
                            placeholder="Distributor Name" 
                            name="first_name" 
                            value="{{ old('first_name') }}">

                        @error('first_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <label>Email <span style="color:red;">*</span></label>
                        <input 
                            type="email" 
                            class="form-control form-control-user @error('email') is-invalid @enderror" 
                            id="exampleEmail"
                            placeholder="Email" 
                            name="email" 
                            value="{{ old('email') }}">

                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Mobile Number --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <label>Mobile Number <span style="color:red;">*</span></label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('mobile_number') is-invalid @enderror" 
                            id="exampleMobile"
                            placeholder="Mobile Number" 
                            name="mobile_number" 
                            value="{{ old('mobile_number') }}">

                        @error('mobile_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- Mobile Number --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <label>Mobile Number <span style="color:red;">*</span></label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('mobile_number') is-invalid @enderror" 
                            id="exampleMobile"
                            placeholder="Mobile Number" 
                            name="mobile_number" 
                            value="{{ old('mobile_number') }}">

                        @error('mobile_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Payment Details</h6>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0" style="margin-top:0px !important">
                        <div class="row">
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Payment Type</label>
                                <select class="form-control form-control-payment @error('status') is-invalid @enderror" name="status">
                                    <option>Select Payment Type</option>
                                    <option value="1">Cheque</option>
                                    <option value="2">NEFT</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0 cheque_payment" style="margin-top:0px !important">
                        <div class="row">
                            {{-- First Name --}}
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>Bank Name <span style="color:red;">*</span></label>
                                <input 
                                    type="text" 
                                    class="form-control form-control-user @error('first_name') is-invalid @enderror" 
                                    id="exampleFirstName"
                                    placeholder="Bank Name" 
                                    name="bank_name" 
                                    value="{{ old('bank_name') }}">

                                @error('bank_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            {{-- Bank IFSC --}}
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>Bank IFSC <span style="color:red;">*</span></label>
                                <input 
                                    type="text" 
                                    class="form-control form-control-user @error('last_name') is-invalid @enderror" 
                                    id="exampleLastName"
                                    placeholder="Bank IFSC" 
                                    name="last_name" 
                                    value="{{ old('last_name') }}">

                                @error('last_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            {{-- Cheque Number --}}
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>Cheque Number <span style="color:red;">*</span></label>
                                <input 
                                    type="email" 
                                    class="form-control form-control-user @error('email') is-invalid @enderror" 
                                    id="exampleEmail"
                                    placeholder="Cheque Number" 
                                    name="email" 
                                    value="{{ old('email') }}">

                                @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0 neft_payment" style="margin-top:0px !important">
                        <div class="row">
                            {{-- First Name --}}
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>Neft Number <span style="color:red;">*</span></label>
                                <input 
                                    type="text" 
                                    class="form-control form-control-user @error('first_name') is-invalid @enderror" 
                                    id="exampleFirstName"
                                    placeholder="Neft Number" 
                                    name="first_name" 
                                    value="{{ old('first_name') }}">

                                @error('first_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            {{-- Last Name --}}
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <label>NEFT Details <span style="color:red;">*</span></label>
                                <input 
                                    type="text" 
                                    class="form-control form-control-user @error('last_name') is-invalid @enderror" 
                                    id="exampleLastName"
                                    placeholder="NEFT Details" 
                                    name="last_name" 
                                    value="{{ old('last_name') }}">

                                @error('last_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Product Details</h6>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0" style="margin-top:0px !important">
                        <div class="row">
                            <div class="col-sm-4 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Payment Type</label>
                                <select class="form-control form-control-payment @error('status') is-invalid @enderror" name="status">
                                    <option>Select Payment Type</option>
                                    <option value="1">Cheque</option>
                                    <option value="2">NEFT</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Save</button>
                {{-- <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('distributor.index') }}">Cancel</a> --}}
            </div>
        </form>
    </div>

</div>


@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.form-control-payment').on('change', function(){
    	        var payment_type = $(this).val(); 
                if(payment_type == 1){
                    $(".cheque_payment").show();
                    $(".neft_payment").hide();
                }
                else if(payment_type == 2){
                    $(".cheque_payment").hide();
                    $(".neft_payment").show();
                }
                else{
                    $(".cheque_payment").hide();
                    $(".neft_payment").hide();
                }
            });
        });
    </script>
@endsection
