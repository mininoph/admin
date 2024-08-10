@extends('layouts.main') 
@section('title', 'Offer')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    @endpush
<style>
    /* HIDE RADIO */
   .input-hidden {
  position: absolute;
  left: -9999px;
}

input[type=radio]:checked + label>img {
  border: 1px solid #fff;
  box-shadow: 0 0 3px 3px #090;
}

/* Stuff after this is only to make things more pretty */
input[type=radio] + label>img {
  border: 1px dashed #444;
  width: 150px;
  height: 150px;
  transition: 500ms all;
}

input[type=radio]:checked + label>img {
  transform: 
    rotateZ(-10deg) 
    rotateX(10deg);
}
</style>
    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Offer')}}</h5>
                            <span>{{ __('Offer')}}</span>
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
                                <a href="#">{{ __('Offer')}}</a>
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
                    Home Screen Style</h3></div>
                    <div class="card-body">
                        <form action="/setting/update" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <input type="hidden" name="type" value="home">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="">
                                            <h6 class="text-center">Style 1</h6>
                                            <label>
                                            <input type="radio" name="home_style" value="0" {{($homestyle == '0') ? 'checked' : '' }}>
                                            <img src="{{URL::asset('img/style1.jpg') }}"
                                                class="avatar avatar-xxl shadow" width="200" height="400">
                                            <label>
                                        </div>
                                        
                                        <div class="">
                                            <h6 class="text-center">Style 2</h6>    
                                            <label>
                                                <input type="radio" name="home_style" value="1" {{($homestyle == '1') ? 'checked' : '' }}>
                                                <img src="{{URL::asset('img/style2.jpg') }}"
                                                    class="avatar avatar-xxl shadow" width="200" height="400"
                                                    alt="Option 1">
                                            <label>
                                        </div>    
                                        
                                        <div class="">
                                            <h6 class="text-center">Style 3</h6>        
                                            <label>
                                                <input type="radio" name="home_style" value="2" {{($homestyle == '2') ? 'checked' : '' }}>
                                                <img src="{{URL::asset('img/style3.jpg') }}"
                                                    class="avatar avatar-xxl shadow" width="200" height="400"
                                                    alt="Option 1">
                                            <label> 
                                        </div> 
                                        
                                        <div class="">
                                            <h6 class="text-center">Style 4</h6>
                                            <label>
                                                <input type="radio" name="home_style" value="3" {{($homestyle == '3') ? 'checked' : '' }}>
                                                <img src="{{URL::asset('img/style4.jpg') }}"
                                                    class="avatar avatar-xxl shadow" width="200" height="400"
                                                    alt="Option 1">
                                            <label>
                                        </div> 
                                        
                                        <div class="">
                                            <h6 class="text-center">Style 5</h6>
                                            <label>
                                                <input type="radio" name="home_style" value="4" {{($homestyle == '4') ? 'checked' : '' }}>
                                                <img src="{{URL::asset('img/style5.jpg') }}"
                                                    class="avatar avatar-xxl shadow" width="200" height="400"
                                                    alt="Option 1">
                                            <label>
                                        </div> 
                                        
                                        <div class="">
                                            <h6 class="text-center">Style 6</h6>
                                            <label>
                                                <input type="radio" name="home_style" value="5" {{($homestyle == '5') ? 'checked' : '' }}>
                                                <img src="{{URL::asset('img/style6.jpg') }}"
                                                    class="avatar avatar-xxl shadow" width="200" height="400"
                                                    alt="Option 1">
                                            <label>         
                                        </div> 
                                        <div class="">
                                            <h6 class="text-center">Style 7</h6>
                                            <label>
                                                <input type="radio" name="home_style" value="6" {{($homestyle == '6') ? 'checked' : '' }}>
                                                <img src="{{URL::asset('img/style7.jpg') }}"
                                                    class="avatar avatar-xxl shadow" width="200" height="400"
                                                    alt="Option 1">
                                            <label>         
                                        </div> 
                                    </div>
                                </div>
                                
                                
                                <button class="btn btn-primary" type="submit">Save</button>
                                
                        </form>        
                    </div>
                </div>
                
                
                <div class="card p-3">
                    <div class="card-header"><h3>
                    
                        <div class="dropdown" style="position: absolute; right: 0; margin-right:30px; margin-top:-30px;">
                              <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action  <i class="ik ik-chevron-down"></i>
                              </button>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <a class="dropdown-item" href="#" id="enable" data-id="offer">{{ __('Enable')}}</a>
                                <a class="dropdown-item" href="#" id="disable" data-id="offer">{{ __('Disable')}}</a>                       
                            </div>
                        </div> 
                    </h3></div>
                    <div class="card-body">
                        <table id="offer_table" class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="sub_chk_all"></th>
                                    <th>{{ __('Task Thumbnail')}}</th>
                                    <th>{{ __('Task Name')}}</th>
                                    <th>{{ __('Task Status')}}</th>
                                    <th>{{ __('Edit')}}</th>
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
    
    
<div class="modal fade" id="updateoffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Task Data')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body bg-white">
                <form class="forms-sample-banner" method="POST" action="/offer/update" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" id="task_offer_id" />
                    <input type="hidden" name="oldicon" id="task_offeroldimage" />


                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Task Title in English</label>
                        <div class="col-sm-12">
                            <input type="text" name="offer_title" id="offer_title" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Task Title in Hindi</label>
                        <div class="col-sm-12">
                            <input type="text" name="offer_title_hi" id="offer_title_hi" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Task Title in Spainsh</label>
                        <div class="col-sm-12">
                            <input type="text" name="offer_title_es" id="offer_title_es" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Task Title in Turkish</label>
                        <div class="col-sm-12">
                            <input type="text" name="offer_title_tr" id="offer_title_tr" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Task Title in Arabic</label>
                        <div class="col-sm-12">
                            <input type="text" name="offer_title_ar" id="offer_title_ar" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Task Order By</label>
                        <div class="col-sm-12">
                            <input type="number" name="item_order" id="offer_item_order" class="form-control" placeholder="1" required/>
                        </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                        <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Task Thumbnail Recommended size 200*200</label>
                        <div class="col-sm-12">
                            <input type="file" name="icon" class="form-control" />
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{ __('Update')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
  
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <!--server side users table script-->
    <script src="{{ asset('js/layouts.js') }}"></script>
    
    <script>
    
      $("body").on("click",".edit-offer",function(){
        var current_object = $(this);
        var id=current_object.attr('data-id');
        
         $.ajax({
            url: 'offer/edit/'+id,
            type: "GET",

            success: function (data) {
                 $("#updateoffer").modal('show');
                 $("#offer_title").val(data['offer_title']);
                 $("#offer_title_tr").val(data['offer_title_tr']);
                 $("#offer_title_hi").val(data['offer_title_hi']);
                 $("#offer_title_es").val(data['offer_title_es']);
                 $("#offer_title_ar").val(data['offer_title_ar']);
                 $("#task_offeroldimage").val(data['offer_icon']);
                 $("#offer_item_order").val(data['item_order']);
                 $("#task_offer_id").val(data['id']);
                 
                console.log(data);
            },
          });    
        

    });
    
           
    $(document).ready(function()
    {
        var searchable = [];
        var selectable = []; 
        
        var dTable = $('#offer_table').DataTable({

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
                url: 'offer/list',
                type: "get"
            },
            columns: [
                {data:'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data:'offer_icon', name: 'offer_icon'},
                {data:'offer_title', name: 'offer_title'},
                {data:'status', name: 'status'},
                {data:'action', name: 'action'}

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
    });
 
        
    </script>
    @endpush
@endsection
