@extends('layouts.main') 
@section('title', 'Update HotOffer')
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
                            <h5>{{ __('Update HotOffer')}}</h5>
                            <span>{{ __('Update HotOffer')}}</span>
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
                        <h3>{{ __('Update HotOffer')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/hotoffer/update" enctype= "multipart/form-data">
                        @csrf
                        
                            <input type="hidden" name="id" value="{{$data->id}}"/>
                            <input type="hidden" name="oldicon" value="{{$data->image}}"/>
                        
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Offer Title')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="title" value="{{$data->title}}" placeholder="Enter Offer Title" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Thumbnail')}}</label>
                                <div class="col-sm-9">
                                    <input id="icon" type="file" class="form-control" name="icon" placeholder="Select Thumbnail" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Offer Complete Coin')}}</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="coin" value="{{$data->coin}}" placeholder="Offer Complete Coin" required>
                                </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Offer Url')}}</label>
                                <div class="col-sm-9">
                                    <input  type="text" class="form-control" name="url" value="{{$data->url}}" placeholder="http" required>
                                    </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Offer Limit')}}</label>
                                <div class="col-sm-9">
                                    <input  type="number" class="form-control" name="task_limit" value="{{$data->task_limit}}" placeholder="how many user can complete offer" required>
                                    </div>
                             </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Offer Instruction')}}</label>
                                <div class="col-sm-9">
                                <textarea class="ckeditor form-control" name="description" required>{{$data->description}}</textarea>
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
