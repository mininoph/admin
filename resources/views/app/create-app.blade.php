@extends('layouts.main') 
@section('title', 'Add App')
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
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Add App')}}</h5>
                            <span>{{ __('Create new App')}}</span>
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
                        <h3>{{ __('Add App')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/apps/create" enctype= "multipart/form-data">
                        @csrf
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('App Name')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="name" placeholder="Enter App Name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Install Coin')}}</label>
                                <div class="col-sm-9">
                                    <input id="coin" type="number" class="form-control" name="coin" placeholder="User get coin when app install" required>
                                </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Packgae Name')}}</label>
                                <div class="col-sm-9">
                                    <input id="package" type="text" class="form-control" name="package"  placeholder="Enter App package name example : com.app.whatsapp" required>
                                    </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Play Store URL')}}</label>
                                <div class="col-sm-9">
                                    <input id="url" type="text" class="form-control" name="url"  placeholder="Enter App Link" required>
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('App ICON')}}</label>
                                <div class="col-sm-9">
                                    <input id="icon" type="file" class="form-control" name="icon" placeholder="Select App ICON" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('App Instruction')}}</label>
                                <div class="col-sm-9">
                                <textarea class="ckeditor form-control" name="detail" required></textarea>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary mr-2">{{ __('Save')}}</button>
                            <button class="btn btn-light">{{ __('Cancel')}}</button>
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
