@extends('layouts.main') @section('title', 'Offerwall & Survey')
@section('content')
<!-- push external head elements to head -->
@push('head')
<link
  rel="stylesheet"
  href="{{ asset('plugins/DataTables/datatables.min.css') }}"
/>
@endpush

<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-end">
      <div class="col-lg-8">
        <div class="page-header-title">
          <i class="ik ik-users bg-blue"></i>
          <div class="d-inline">
            <h5>{{ __('Offerwall & Survey')}}</h5>
            <span>{{ __('List of Offerwall & Survey')}}</span>
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
              <a href="#">{{ __('Offerwall & Survey')}}</a>
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
        <div class="card-header">
          <h3>
            <a class="btn btn-info btn-sm" href="/offerwall/create"
              >{{ __('Create New')}}</a>
              
               <div class="dropdown" style="position: absolute; right: 0; margin-right:30px; margin-top:-30px;">
                  <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action  <i class="ik ik-chevron-down"></i>
                  </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <a class="dropdown-item" href="#" id="enable" data-id="offerwall">{{ __('Enable')}}</a>
                        <a class="dropdown-item" href="#" id="disable" data-id="offerwall">{{ __('Disable')}}</a>                       
                    </div>
              </div> 
            
          </h3>
        </div>
        <div class="card-body">
          <table id="r_table" class="table">
            <thead>
              <tr>
                <th><input type="checkbox" class="sub_chk_all"></th>
                <th>{{ __('Icon')}}</th>
                <th>{{ __('Title')}}</th>
                <th>{{ __('Offerwall Type')}}</th>
                <th>{{ __('Total Earning')}}</th>
                <th>{{ __('Level')}}</th>
                <th>{{ __('Status')}}</th>
                <th>{{ __('Action')}}</th>
              </tr>
            </thead>
            <tbody></tbody>
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
<!--server side users table script-->
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/layouts.js') }}"></script>

<script>
  $(document).ready(function () {
    var searchable = [];
    var selectable = [];

    var dTable = $("#r_table").DataTable({
      order: [],
      lengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"],
      ],
      processing: true,
      responsive: false,
      serverSide: true,
      processing: true,
      language: {
        processing:
          '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>',
      },
      scroller: {
        loadingIndicator: false,
      },
      pagingType: "full_numbers",
      dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
      ajax: {
        url: "offerwall/list",
        type: "get",
      },
      columns: [
        { data: "DT_RowIndex", name: "DT_RowIndex" ,orderable: false, searchable: false},
        { data: "thumb", name: "thumb" },
        { data: "title", name: "title", orderable: false, searchable: true },
        { data: "offer_type", name: "offer_type" }, // add column name
        { data: "earning", name: "earning" },
        { data: "level", name: "level" }, // add column name
        { data: "status", name: "status" },
        { data: "action", name: "action" },
      ],

      initComplete: function () {
        var api = this.api();
        api.columns(searchable).every(function () {
          var column = this;
          var input = document.createElement("input");
          input.setAttribute("placeholder", $(column.header()).text());
          input.setAttribute(
            "style",
            "width: 140px; height:25px; border:1px solid whitesmoke;"
          );

          $(input)
            .appendTo($(column.header()).empty())
            .on("keyup", function () {
              column.search($(this).val(), false, false, true).draw();
            });

          $("input", this.column(column).header()).on("click", function (e) {
            e.stopPropagation();
          });
        });

        api.columns(selectable).every(function (i, x) {
          var column = this;

          var select = $(
            '<select style="width: 140px; height:25px; border:1px solid whitesmoke; font-size: 12px; font-weight:bold;"><option value="">' +
              $(column.header()).text() +
              "</option></select>"
          )
            .appendTo($(column.header()).empty())
            .on("change", function (e) {
              var val = $.fn.dataTable.util.escapeRegex($(this).val());
              column.search(val ? "^" + val + "$" : "", true, false).draw();
              e.stopPropagation();
            });

          $.each(dropdownList[i], function (j, v) {
            select.append('<option value="' + v + '">' + v + "</option>");
          });
        });
      },
    });
  });
  
    $("body").on("click",".copy-postback",function(){
    var current_object = $(this);
    var id = current_object.attr('data-id');
     $("#postbackmodal").modal('show');
     $("#postback").val(id);
    
    });
  

  $("body").on("click", ".remove-offerwall", function () {
    var current_object = $(this);
    var id = current_object.attr("data-id");
    swal({
      title: "Are you sure?",
      text: "Do you really want to delete this item?",
      icon: "warning",
      buttons: ["Cancel", "Delete Now"],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: "/offerwall/delete/" + id,
          type: "get",
          success: function (data) {
            if (data == 1) {
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
@endpush @endsection
