@extends('layouts.main') 
@section('title', 'Edit Video')
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
                            <h5>{{ __('Edit Video')}}</h5>
                            <span>{{ __('')}}</span>
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
                        <h3>{{ __('Edit Video')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/videos/update" enctype= "multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$video->id}}"/>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Video Title')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$video->title}}" placeholder="Enter Video Title" required>
                                <div class="help-block with-errors"></div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Youtube Video Link')}}</label>
                                <div class="col-sm-9">
                                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{$video->url}}" placeholder="eg : http://youtu.be/dQw4w9WgXcQ" required>
                                        <div class="help-block with-errors" ></div>
                                        @error('url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                     </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Video Timer')}}</label>
                                <div class="col-sm-9">
                                    <input id="timer" type="text" class="form-control @error('package') is-invalid @enderror" name="timer" value="{{$video->timer}}" placeholder="Enter Timer Value in Minute eg 1" required>
                                        <div class="help-block with-errors"></div>
                                        @error('timer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Video Watch Coin')}}</label>
                                <div class="col-sm-9">
                                    <input id="point" type="number" class="form-control @error('url') is-invalid @enderror" name="point" value="{{$video->point}}" placeholder="Coin eg:4" required>
                                        <div class="help-block with-errors"></div>

                                        @error('point')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Open Video In')}}</label>
                                <div class="col-sm-9">
                                  <select name="browser_type" class="form-control" required>
                                      <option value="1" {{($video->browser_type == '1') ? 'selected' : ''}}> Youtube Video Player</option>
                                      <option value="0" {{($video->browser_type == '0') ? 'selected' : ''}}> Open In Webview</option>
                                  </select>
                                </div>
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
