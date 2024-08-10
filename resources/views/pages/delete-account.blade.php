@extends('layouts.app')
@section('title', 'Create Website')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
             <div class="col-md-3"></div>
            <div class="col-md-6 " style="margin-top:100px;">
                
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Delete Account Request')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/submit-delete-account-request">
                        @csrf
                    
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Name')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="username" placeholder="UserName" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Email')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="email" class="form-control @error('name') is-invalid @enderror" name="email" placeholder="john@gmail.com" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Why you want to delete account ? (optional)</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="remark" placeholder="" >
                                </div>
                            </div>

                            

                            <button type="submit" class="btn btn-primary mr-2">{{ __('Submit Request')}}</button>
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
