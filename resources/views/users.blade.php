@extends('layouts.main') 
@section('title', 'Users')
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
                            <h5>{{ __('Users')}}</h5>
                            <span>{{ __('List of users')}}</span>
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
                                <a href="#">{{ __('Users')}}</a>
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
                    <div class="card-header"><h3>{{ __('Users')}}</h3></div>
                    <div class="card-body">
                        <table id="user_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('s no.')}}</th>
                                    <th>{{ __('Profile')}}</th>
                                    <th>{{ __('Name')}}</th>
                                    <th>{{ __('Phone')}}</th>
                                    <th>{{ __('Email')}}</th>
                                    <th>{{ __('Ip')}}</th>
                                    <th>{{ __('Balance')}}</th>
                                    <th>{{ __('Status')}}</th>
                                    <th>{{ __('Registration')}}</th>
                                    <th>{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="justify-content-center">
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
    <!--server side users table script-->
    <script src="{{ asset('js/layouts.js') }}"></script>
    
    <script>
        $("body").on("click",".add-user-coin",function(){
            $("#updateCoinModel").modal('show');
            var current_object = $(this);
            var id=current_object.attr('data-id');
            console.log('user-coin-id '+id);
            $("#coin_user_id").val(id);
        });
        
        $("body").on("click",".update-profile",function(){
            $("#updateUserModel").modal('show');
            var current_object = $(this);
            var id=current_object.attr('data-id');
            
             $("#profile_icon").val(current_object.attr('profile'));            
             $("#profile_username").val(current_object.attr('name'));            
             $("#profile_phone").val(current_object.attr('phone'));            
             $("#profile_email").val(current_object.attr('email'));            
             $("#profile_password").val(current_object.attr('password'));            
             $("#profile_user_id").val(id);            
            
        });
        
        
    
    </script>
    
    <script>
        
           var searchable = [];
        var selectable = []; 
        
        var dTable = $('#user_table').DataTable({

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
                url: 'user/get-list/0',
                type: "get"
            },
            columns: [
                {data:'DT_RowIndex', name: 'DT_RowIndex', "searchable": false},
                {data:'profile', name: 'profile', "searchable": true},
                {data:'name', name: 'name', "searchable": true},
                {data:'phone', name: 'phone', "searchable": true}, // add column name
                {data:'email', name: 'email', "searchable": true},
                {data:'ip', name: 'ip', "searchable": true}, // add column name
                {data:'balance', name: 'balance', "searchable": true},
                {data:'status', name: 'status', "searchable": false},
                {data:'inserted_at', name: 'inserted_at', "searchable": true},
                {data:'action', name: 'action', "searchable": false}

            ],
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-sm btn-info',
                    title: 'Users',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-sm btn-success',
                    title: 'Users',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-sm btn-warning',
                    title: 'Users',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible',
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm btn-primary',
                    title: 'Users',
                    pageSize: 'A2',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-sm btn-default',
                    title: 'Users',
                    // orientation:'landscape',
                    pageSize: 'A2',
                    header: true,
                    footer: false,
                    orientation: 'landscape',
                    exportOptions: {
                        // columns: ':visible',
                        stripHtml: false
                    }
                }
            ]
        });
    </script>

    @endpush
@endsection
