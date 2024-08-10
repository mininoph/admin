@extends('layouts.main') 
@section('title', 'Spinner')
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
                            <h5>{{ __('Spinner')}}</h5>
                            <span>{{ __('')}}</span>
                        </div>
                        </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-target"></i></a>
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
                        <h3>{{ __('Spinner Setting')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/setting/spinupdate">
                        @csrf

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Position 1')}}</label>
                                <div class="col-sm-1">
                                     <input type="color" class="form-control" style="height:35px; width:80px;"  value="{{$data[0]->pc_1}}" name="pc_1" required>
                                </div>
                                <div class="col-sm-4">
                                     <input type="number" class="form-control " name="p_1"  value="{{$data[0]->position_1}}" placeholder=" Coin" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Position 2')}}</label>
                                <div class="col-sm-1">
                                     <input type="color" class="form-control" style="height:35px; width:80px;"  value="{{$data[0]->pc_2}}" name="pc_2" value="" required>
                                </div>
                                <div class="col-sm-4">
                                     <input type="number" class="form-control " name="p_2"  value="{{$data[0]->position_2}}" placeholder="Coin" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Position 3')}}</label>
                                <div class="col-sm-1">
                                     <input type="color" class="form-control" style="height:35px; width:80px;"  value="{{$data[0]->pc_3}}" name="pc_3" value="" required>
                                </div>
                                <div class="col-sm-4">
                                     <input type="number" class="form-control " name="p_3"  value="{{$data[0]->position_3}}" placeholder="Coin" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Position 4')}}</label>
                                <div class="col-sm-1">
                                     <input type="color" class="form-control" style="height:35px; width:80px;"  value="{{$data[0]->pc_4}}" name="pc_4"  required>
                                </div>
                                <div class="col-sm-4">
                                     <input type="number" class="form-control " name="p_4"  value="{{$data[0]->position_4}}" placeholder="Coin" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Position 5')}}</label>
                                <div class="col-sm-1">
                                     <input type="color" class="form-control" style="height:35px; width:80px;" name="pc_5"  value="{{$data[0]->pc_5}}" required>
                                </div>
                                <div class="col-sm-4">
                                     <input type="number" class="form-control " name="p_5"  value="{{$data[0]->position_5}}" placeholder="Coin" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Position 6')}}</label>
                                <div class="col-sm-1">
                                     <input type="color" class="form-control" style="height:35px; width:80px;" name="pc_6"  value="{{$data[0]->pc_6}}" required>
                                </div>
                                <div class="col-sm-4">
                                     <input type="number" class="form-control " name="p_6"  value="{{$data[0]->position_6}}" placeholder="Coin" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Position 7')}}</label>
                                <div class="col-sm-1">
                                     <input type="color" class="form-control" style="height:35px; width:80px;" name="pc_7"  value="{{$data[0]->pc_7}}" required>
                                </div>
                                <div class="col-sm-4">
                                     <input type="number" class="form-control " name="p_7"  value="{{$data[0]->position_7}}" placeholder="Coin" required>
                                </div>
                            </div>   

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Position 8')}}</label>
                                <div class="col-sm-1">
                                     <input type="color" class="form-control" style="height:35px; width:80px;" name="pc_8"  value="{{$data[0]->pc_8}}" required>
                                </div>
                                <div class="col-sm-4">
                                     <input type="number" class="form-control " name="p_8"  value="{{$data[0]->position_8}}" placeholder="Coin" required>
                                </div>
                            </div>
                        

                            <button type="submit" class="btn btn-primary m-10 float-right">{{ __('Update')}}</button>
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
