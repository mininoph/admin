@extends('layouts.main') 
@section('title', 'Youtube Videos')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Videos')}}</h5>
                            <span>{{ __('List of Videos')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Videos')}}</a>
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
                <div class="card p-3">
                    <div class="card-header"><h3>
                    <a class="btn btn-info btn-sm" href="/videos/create-video">{{ __('Create New')}}</a>
                        </h3></div>
                    <div class="card-body">
                        <table id="video_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Serial No.')}}</th>
                                    <th>{{ __('Title')}}</th>
                                    <th>{{ __('Video ID')}}</th>
                                    <th>{{ __('Coin')}}</th>
                                    <th>{{ __('Timer')}}</th>
                                    <th>{{ __('Created Date')}}</th>
                                    <th>{{ __('View')}}</th>
                                    <th>{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('model')
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
<!--server side users table script-->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/layouts.js') }}"></script>
    @endpush
@endsection
