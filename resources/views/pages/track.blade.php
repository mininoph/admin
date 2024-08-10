@extends('layouts.main') 
@section('title', 'User Transaction')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
          <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
  @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Transaction')}}</a>
                                <input type="hidden" id="id" value="{{$id}}"/>
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
                    <div class="card-header"><h3>{{ __('User Profile')}}</h3></div>
                    <div class="card-body">
                        <div class="row">
                            <div class ="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('UserName')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="{{$user->name}}" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <div class ="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Email')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="{{$user->email}}" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <div class ="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Phone No.')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="{{$user->phone}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class ="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Invited By')}}</label>
                                    <div class="col-sm-12">
                                        
                                        <?php
                                            if(empty($fromrefer->name)){?>
                                                <input type="text" class="form-control" value="" readonly>
                                          <?php  }else{?>
                                            <div class="row">
                                                <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$fromrefer->name}}" readonly>
                                                </div>
                                               <div class="col-sm-2"> 
                                               <a href="/user/track/{{$fromrefer->uid}}" target="blank" class="btn btn-primary"> Click to track {{$fromrefer->name}}</a>
                                               </div>
                                            </div>   
                                           <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class ="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Referral ID')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="{{$user->refferal_id}}" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <div class ="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Account Type')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="{{$user->type}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class ="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Wallet Coin')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="{{$user->balance}}" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <div class ="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Account Status')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="{{($user->status == 0 ) ? 'Active' : 'Blocked'}}" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <div class ="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Last Account Banned Time.')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="{{$user->banned_time}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class ="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Account Ban Reason')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="{{$user->reason}}" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <div class ="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label"><br></label>
                                    <div class="col-sm-12">
                                         <div class="row">
                                            <button type="button" class="btn btn-success update-profile" data-id="{{$user->uid}}" name="{{$user->name}}" email="{{$user->email}}" password="{{$user->password}}" profile="{{$user->profile}}" phone="{{$user->phone}}" ><i class="ik ik-edit"></i>Edit Profile</button>
&nbsp; &nbsp;
                                            <button type="button" class="btn btn-info add-user-coin" data-id="{{$id}}" ><i class="ik ik-plus"></i>Update Coin</button>&nbsp; &nbsp;
                                            <button type="button" class="btn btn-warning status" data-id="{{$id}}" id="{{ ($user->status == 0) ? '1' : '0' }}" ><i class="ik ik-plus"></i>{{ ($user->status == 0) ? 'Block User' : 'Unblock User' }}</button>&nbsp; &nbsp;
                                            <button type="button" class="btn btn-danger remove-user" data-id="{{$id}}" ><i class="ik ik-trash"></i>Delete Account</button>&nbsp; &nbsp;
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>     
                             
                <div class="card p-3">
                    <div class="card-header"><h3>{{ __('Rewards Transaction')}}</h3></div>
                    <div class="card-body">
                        <table id="user_redeem" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('sr No.')}}</th>
                                    <th>{{ __('User')}}</th>
                                    <th>{{ __('Request To')}}</th>
                                    <th>{{ __('Coin Used')}}</th>
                                    <th>{{ __('Amount')}}</th>
                                    <th>{{ __('Type')}}</th>
                                    <th>{{ __('Request Date')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header"><h3>{{ __('User Transaction')}}</h3></div>
                    <div class="card-body">
                        <table id="user_transe" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('sr no.')}}</th>
                                    <th>{{ __('Name')}}</th>
                                    <th>{{ __('Amount')}}</th>
                                    <th>{{ __('Type')}}</th>
                                    <th>{{ __('Remained Coin')}}</th>
                                    <th>{{ __('Remark')}}</th>
                                    <th>{{ __('Date')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header"><h3>{{ __('Invited User List')}}</h3></div>
                    <div class="card-body">
                        <table id="user_invite_list" class="table">
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
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @include('model')
    @push('script')
     <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
   <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/layouts.js') }}"></script>
<!--server side users table script-->
    
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
        
    // user pending request
        var id= $('#id').val();
        console.log('after redeem id'+id);
            
            var searchable = [];
            var selectable = []; 
            
            var dTable = $('#user_redeem').DataTable({
                    
                order: [],
                lengthMenu: [[5, 10, 20, 30, -1], [5, 10, 20, 30, "All"]],
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
                    url: '/request/'+id,
                    type: "get"
                },
                columns: [
                    {data:'DT_RowIndex', name: 'DT_RowIndex', "searchable": false},
                    {data:'name', name: 'name', "searchable": false},
                    {data:'mobile_no', name: 'mobile_no', "searchable": true},
                    {data:'amount', name: 'amount', "searchable": false}, // add column name
                    {data:'orginal_amount', name: 'orginal_amount', "searchable": false},
                    {data:'type', name: 'type', "searchable": true},
                    {data:'date', name: 'date', "searchable": false}
        
                ],
                buttons: [
                    {
                        extend: 'copy',
                        className: 'btn-sm btn-info',
                        title: 'Users Transaction',
                        header: false,
                        footer: true,
                        exportOptions: {
                            // columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-sm btn-success',
                        title: 'Pending Request',
                        header: false,
                        footer: true,
                        exportOptions: {
                            // columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-sm btn-warning',
                        title: 'Pending Request',
                        header: false,
                        footer: true,
                        exportOptions: {
                            // columns: ':visible',
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-sm btn-primary',
                        title: 'Pending Request',
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
                        title: 'Pending Request',
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
            
            var dTable = $('#user_invite_list').DataTable({
                    
                order: [],
                lengthMenu: [[5, 10, 20, 30, -1], [5, 10, 20, 30, "All"]],
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
                    url: '/users/invited/'+'{{ $user->refferal_id }}',
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
                        title: 'Users Transaction',
                        header: false,
                        footer: true,
                        exportOptions: {
                            // columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-sm btn-success',
                        title: 'Pending Request',
                        header: false,
                        footer: true,
                        exportOptions: {
                            // columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-sm btn-warning',
                        title: 'Pending Request',
                        header: false,
                        footer: true,
                        exportOptions: {
                            // columns: ':visible',
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-sm btn-primary',
                        title: 'Pending Request',
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
                        title: 'Pending Request',
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
       
     
    //  user transactions
        var searchable = [];
        var selectable = []; 
        var dTable = $('#user_transe').DataTable({
    
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
                url: '/transaction/'+id,
                type: "get"
            },
            columns: [
                {data:'DT_RowIndex', name: 'DT_RowIndex', "searchable": false},
                {data:'name', name: 'name', "searchable": false},
                {data:'amount', name: 'amount', "searchable": false},
                {data:'tran_type', name: 'tran_type', "searchable": false}, // add column name
                {data:'remained_balance', name: 'remained_balance', "searchable": false},
                {data:'remarks', name: 'remarks', "searchable": false},
                {data:'inserted_at', name: 'inserted_at', "searchable": false}
    
            ],
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-sm btn-info',
                    title: 'Users Transaction',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-sm btn-success',
                    title: 'Users Transaction',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-sm btn-warning',
                    title: 'Users Transaction',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible',
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm btn-primary',
                    title: 'Users Transaction',
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
                    title: 'Users Transaction',
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
