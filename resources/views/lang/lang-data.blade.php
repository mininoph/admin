@extends('layouts.main') @section('title', 'Language Data') @section('content')
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" />
@endpush

<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-user-plus bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Update Language Data')}}</h5>
                        <span>{{ __('Language Data')}}</span>
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
            <div class="card">
                <div class="form-group row">
                    <div class="col-sm-12 mt-5">
                       <label for="exampleInputPassword2" class="col-sm-12 col-form-label">{{ __('Select Language')}}</label>
                        <div class="col-sm-12">
                            
                            <select class="form-control" name="category" onchange="javascript:location.href = this.value;">
                                @foreach($lang as $item)
                                <option value="/language/data?lang={{$item->code}}" {{ (request()->get('lang') == $item->code ) ? 'selected' : ''}} >{{$item->title}}</option>
                                @endforeach
                            </select>
                            
                        </div> 
                    </div>    
                 </div>
                <div class="card-header">
                    <h3>{{ __('Language Configuration')}}</h3>
                </div>
                <div class="card-body">
                    <form class="forms-sample" method="POST" action="/language/update-lang-txt" enctype="multipart/form-data">
                      <input type="hidden" value="{{request()->get('lang')}}" name="selected_lang">
                        @csrf
                    <div class="form-group row">
                        @if(count($data) > 0)
                        @foreach($data as $item)
                        <div class="col-sm-4 mt-2">
                            <label for="exampleInputPassword2" class="col-sm-12 col-form-label"><b>{{$item->txt_key}}</b></label>
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" name="lang_id[]" value="{{$item->id}}">
                                <input type="text" class="form-control" name="langval[]" value="{{$item->txt_value}}" placeholder=""
                                    required>
                            </div>
                        </div>

                        @endforeach
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">
                        {{ __('Update')}}
                    </button>
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

    <script>


    </script>
    @endpush @endsection
</div>