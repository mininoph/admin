@extends('layouts.main') 
@section('title', 'Edit Redeem')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                    <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                                                    
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <!-- <a href="#">{{ __('Add User')}}</a> -->
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Edit  Rewards')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/payment-options/update" enctype= "multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$redeem->id}}"/>
                        <input type="hidden" name="oldimage" value="{{$redeem->image}}"/>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Redeem Name')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$redeem->title}}" placeholder="Name" required>
                                <div class="help-block with-errors"></div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Coin Required for Redeem')}}</label>
                                <div class="col-sm-9">
                                    <input id="coin" type="number" class="form-control @error('coin') is-invalid @enderror" name="coin" value="{{$redeem->points}}" placeholder="eg 1000" required>
                                        <div class="help-block with-errors" ></div>
                                        @error('coin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                     </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Set Currency: ( $1 USD )')}}</label>
                                <div class="col-sm-9">
                                    <input id="currency" type="text" class="form-control @error('currency') is-invalid @enderror" name="currency" value="{{$redeem->pointvalue}}" placeholder="Set Currency eg 1USD" required>
                                        <div class="help-block with-errors"></div>
                                        @error('package')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                             </div>

                             <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Details:')}}</label>
                                <div class="col-sm-9">
                                    <input id="detail" type="text" class="form-control @error('detail') is-invalid @enderror" name="detail" value="{{$redeem->description}}" placeholder="eg: 1000 coin = 1 USD" required>
                                        <div class="help-block with-errors"></div>
                                        @error('package')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                             </div>


                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Redeem Icon')}}</label>
                                <div class="col-sm-9">
                                    <input id="icon" type="file" class="form-control @error('icon') is-invalid @enderror" name="icon" placeholder="Select App ICON" >
                                        <div class="help-block with-errors"></div>

                                        @error('icon')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            
                             <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Redeem Hint:')}}</label>
                                <div class="col-sm-9">
                                    <input id="hint" type="text" class="form-control @error('hint') is-invalid @enderror" name="hint" value="{{$redeem->hint}}"  placeholder="Enter Wallet Address" required>
                                        <div class="help-block with-errors"></div>
                                        @error('hint')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                             </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Input Type')}}</label>
                                <div class="col-sm-9">
                                    <select name="input_type" class="form-control">
                                        <option value="0" {{($redeem->input_type == '0') ? 'selected' : ''}}>Text</option>
                                        <option value="1" {{($redeem->input_type == '1') ? 'selected' : ''}}>Email</option>
                                        <option value="2" {{($redeem->input_type == '2') ? 'selected' : ''}}>Number</option>
                                    </select>
                             </div>
                           
                            <button type="submit" class="btn btn-primary mr-2">{{ __('Update')}}</button>
                        </form>
                    </div>
                  </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
       <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
         <!--get role wise permissiom ajax script-->
    @endpush
@endsection
