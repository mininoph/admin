@extends('layouts.main') 
@section('title', 'Manage Admin')
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
                            <h5>{{ __('Admin List')}}</h5>
                            <span>{{ __('Admin')}}</span>
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
                                <a href="#">{{ __('Admin')}}</a>
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
                    <Button class="btn btn-info btn-sm create-admin">{{ __('Add Admin')}}</Button>
                    </h3></div>
                    <div class="card-body">
                        <table id="admin_table" class="table">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>{{ __('Name')}}</th>
                                  	<th>{{ __('Email')}}</th>
                                  	<th>{{ __('Created AT')}}</th>
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
    <!--server side users table script-->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/layouts.js') }}"></script>
    
    <script>
        // weblist
    $(document).ready(function()
    {
        var searchable = [];
        var selectable = []; 
        
        var dTable = $('#admin_table').DataTable({
    
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
                url: '/admins/list',
                type: "get"
            },
            columns: [
                {data:'DT_RowIndex', name: 'DT_RowIndex', "searchable": false},
                {data:'name', name: 'name', "searchable": true},
              	{data:'email', name: 'email', "searchable": true},
                {data:'created_at', name: 'created_at', "searchable": true},
                {data:'action', name: 'action', "searchable": false}
    
            ],
            buttons: []
        });
    });
      
      
   $("body").on("click",".create-admin",function(){
     $("#adminmodel").modal('show');
    });
    
   $("body").on("click",".edit-admin",function(){
        var current_object = $(this);
        var id=current_object.attr('data-id');
        $.ajax({
            url: 'admins/edit/'+id,
            type: "GET",

            success: function (data) {
                console.log(data)
                 $("#updateAdmin").modal('show');
                 $("#adminEmail").val(data['email']);
                 $("#adminName").val(data['name']);
                 $("#adminid").val(data['id']);
              	$("#adminpass").val(data['password']);
            },
          });
     
    });
       
      
    $("body").on("click",".remove-admin",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete Admin?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/admins/delete/'+id,
                        type: "get",
                        success: function (data) {
                            if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "Admin Has been deleted !",
                                icon: "success",
                            });
                        }
                        },
                        error: console.log("it did not work"),
                        });
                } else {
                    swal("The item is not deleted!");
                }
            });
        });  
    
    </script>

    @endpush
@endsection
