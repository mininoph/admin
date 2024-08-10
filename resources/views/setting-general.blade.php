@extends('layouts.main') 
@section('title', 'General Setting')
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
                            <h5>{{ __('General Setting')}}</h5>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('General Setting')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/setting/update" enctype= "multipart/form-data">
                        @csrf
                            <input type=hidden name="oldicon" value="{{$data[0]->app_icon}}"/>
                            <input type=hidden name="type" value="general"/>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('App Name')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control " name="app_name" value="{{$data[0]->app_name}}" placeholder="App Name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('App Version')}}</label>
                                <div class="col-sm-9">
                                    <input id="version" type="text" class="form-control" name="version" value="{{$data[0]->app_version}}" placeholder="App Version" required>
                                     </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Author')}}</label>
                                <div class="col-sm-9">
                                    <input id="author" type="text" class="form-control " value="{{$data[0]->app_author}}"name="author" placeholder="Author" required>
                                    </div>
                             </div>

                           
                            
                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Privacy Policy URL')}}</label>
                                <div class="col-sm-9">
                                    <input id="website" type="text" class="form-control" value="{{$data[0]->privacy_policy}}" name="privacy_policy" placeholder="https//example.com" >
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('App ICON')}}</label>
                                <div class="col-sm-9">
                                    <input id="icon" type="file" class="form-control" name="icon" placeholder="Select App ICON">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('App Share Message')}}</label>
                                <div class="col-sm-9">
                                <textarea class="ckeditor form-control" name="share_msg" required>{{$data[0]->share_msg}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('About Us')}}</label>
                                <div class="col-sm-9">
                                <textarea class="ckeditor form-control" name="detail" required>{{$data[0]->app_description}}</textarea>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary mr-2 float-right">{{ __('Update')}}</button>
                        </form>
                    </div>
                  </div>
        </div>
        
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Social Links')}}</h3>
                    </div>
                    <div class="card-body">
                    <Button class="btn btn-info btn-sm create-social">{{ __('Add New')}}</Button>
                    <div class="card-body">
                        <table id="social_table" class="table">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>{{ __('Icon')}}</th>
                                    <th>{{ __('Title')}}</th>
                                    <th>{{ __('Url')}}</th>
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
    @include('model')
        <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        
        <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
         <!--get role wise permissiom ajax script-->
         
        <script>
           
       $("body").on("click",".create-social",function(){
         $("#socialmodel").modal('show');
        });
        
        
        $("body").on("click",".edit-social",function(){
            var current_object = $(this);
            var id=current_object.attr('data-id');
            
            $.ajax({
                url: 'social-link/edit/'+id,
                type: "GET",
    
                success: function (data) {
                     $("#updatesocialmodel").modal('show');
                     $("#social_id").val(id);
                     $("#social_title").val(data['title']);
                     $("#social_icon").val(data['image']);
                     $("#social_url").val(data['url']);
                     var selected = data['status'];
                    $('#social_status option[value="'+ selected +'"]').attr("selected", "selected");
                    console.log(data);
                },
              });
         
        });
      
        $("body").on("click",".remove-social",function(){
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
                        url: '/social-link/delete/'+id,
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
        
          
        // weblist
    $(document).ready(function()
    {
        var searchable = [];
        var selectable = []; 
        
        var dTable = $('#social_table').DataTable({
    
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
                url: '/social-link/list',
                type: "get"
            },
            columns: [
                {data:'DT_RowIndex', name: 'DT_RowIndex', "searchable": false},
                {data:'image', name: 'image', "searchable": false},
                {data:'title', name: 'title', "searchable": true},
                {data:'url', name: 'url', "searchable": true}, // add column name
                {data:'action', name: 'action', "searchable": false}
    
            ],
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-sm btn-info',
                    title: 'Social Links',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-sm btn-success',
                    title: 'Social Links',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-sm btn-warning',
                    title: 'Social Links',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible',
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm btn-primary',
                    title: 'Social Links',
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
                    title: 'Social Links',
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
    });
    
    </script>

    @endpush
@endsection
