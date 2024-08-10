@extends('layouts.main') 
@section('title', 'Hot Offer')
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
                        <i class="ik ik-gift bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Hot Offer')}}</h5>
                            <span>{{ __('List of Hot Offer')}}</span>
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
                                <a href="#">{{ __('Hot Offer')}}</a>
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
                    <a class="btn btn-info btn-sm" href="/hotoffer/create">{{ __('Add New')}}</a>
                    </h3></div>
                    <div class="card-body">
                        <table id="hotoffer_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Serial No.')}}</th>
                                    <th>{{ __('Thumbnail')}}</th>
                                    <th>{{ __('Title')}}</th>
                                    <th>{{ __('Coin')}}</th>
                                    <th>{{ __('Offer Url')}}</th>
                                    <th>{{ __('Offer Limit')}}</th>
                                    <th>{{ __('Created Date')}}</th>
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
        
        var dTable = $('#hotoffer_table').DataTable({
    
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
                url: '/hotoffer/list',
                type: "get"
            },
            columns: [
                {data:'DT_RowIndex', name: 'DT_RowIndex', "searchable": false},
                {data:'image', name: 'image', "searchable": false},
                {data:'title', name: 'title', "searchable": true},
                {data:'coin', name: 'coin', "searchable": false}, // add column name
                {data:'url', name: 'url', "searchable": true},
                {data:'views', name: 'views', "searchable": false},
                {data:'created_at', name: 'created_at', "searchable": false},
                {data:'action', name: 'action', "searchable": false}
    
            ],
            buttons: []
        });
    });
    
    
    // delete redeem
    $("body").on("click",".remove-hotoffer",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "Do you really want to delete this item?",
                icon: "warning",
                buttons: ["Cancel", "Delete Now"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/hotoffer/delete/'+id,
                        type: "get",
                        success: function (data) {
                            if(data==1){
                            location.reload();
                            swal({
                                title: "Deleted",
                                text: "item has been deleted !",
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
