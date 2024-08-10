@extends('layouts.main') 
@section('title', 'Approved Task')
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
                            <h5>{{ __('Approved Task')}}</h5>
                            <span>{{ __('List of Approved Task')}}</span>
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
                                <a href="#">{{ __('Approved Task')}}</a>
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
                    <div class="card-header"><h3>{{ __('Approved Task')}}</h3></div>
                    <div class="card-body">
                        <table id="a_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Serial No.')}}</th>
                                    <th>{{ __('Proof')}}</th>
                                    <th>{{ __('UserName')}}</th>
                                    <th>{{ __('User Message')}}</th>
                                    <th>{{ __('Offer Name')}}</th>
                                    <th>{{ __('Submit Date')}}</th>
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
   


        <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <!--server side users table script-->
    <script src="{{ asset('js/custom.js') }}"></script>
     <script src="{{ asset('js/layouts.js') }}"></script>
     
     <script>
      $(document).ready(function()
      {
        var searchable = [];
        var selectable = []; 
        
        var dTable = $('#a_table').DataTable({
    
            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            processing: true,
            responsive: false,
            serverSide: true,
            processing: true,
            language: {
              processing: '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>'
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            ajax: {
                url: '/hotoffer/list/approved',
                type: "get"
            },
            columns: [
                {data:'DT_RowIndex', name: 'DT_RowIndex', "searchable": false},
                {data:'image', name: 'image', "searchable": false},
                {data:'username', name: 'username', "searchable": true},
                {data:'message', name: 'message', "searchable": true},
                {data:'title', name: 'title', "searchable": false}, // add column name
                {data:'created_at', name: 'created_at', "searchable": false},
                {data:'action', name: 'action', "searchable": false}
            ],
            buttons: []
        });
    });

      
        
     </script>
    @endpush
@endsection
