(function($) {
    'use strict';

   $("body").on("click",".create-game",function(){
     $("#gamemodel").modal('show');
    });
    
    $("body").on("click",".create-game",function(){
     $("#gamemodel").modal('show');
    });
    
        
   $("body").on("click",".create-banner",function(){
     $("#bannermodel").modal('show');
    });
     

   $("body").on("click",".edit-banner",function(){
        var current_object = $(this);
        var id=current_object.attr('data-id');
        
        $.ajax({
            url: 'banner/edit/'+id,
            type: "GET",

            success: function (data) {
                 $("#updatebanner").modal('show');
                 $("#link").val(data['link']);
                 $("#oldimagebanner").val(data['banner']);
                 $("#bannersid").val(data['id']);
                 var selectedUser = data['onclick'];
                $('#type option[value="'+ selectedUser +'"]').attr("selected", "selected");
                console.log(data);
            },
          });
     
    });
    
   
    $("body").on("click",".remove-banner",function(){
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
                        url: '/banner/delete/'+id,
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
        
     
      //delete app 
    $("body").on("click",".remove-app",function(){
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
                        url: '/apps/delete/'+id,
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

    // delete user
    $("body").on("click",".remove-user",function(){
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
                        url: '/users/delete/'+id,
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

    // delete payment request
    $("body").on("click",".remove-paymentreq",function(){
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
                        url: '/request/delete/'+id,
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

    // delete web
    $("body").on("click",".remove-web",function(){
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
                        url: '/websites/delete/'+id,
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

    // delete video
    $("body").on("click",".remove-video",function(){
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
                    url: '/videos/delete/'+id,
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


    // delete redeem
    $("body").on("click",".remove-redeem",function(){
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
                        url: '/payment-options/delete/'+id,
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


   // status
   $("body").on("click",".status",function(){
    var current_object = $(this);
    var id = current_object.attr('data-id');
    var ids = current_object.attr('id');
    console.log('status id '+id);
     $("#status").modal('show');
     $("#stid").val(id);
     if(ids==1){
        $("#exampleModalCenterLabel").val("UnBLOCK");
     }
     $("#st").val(ids);
    });
 

       $("body").on("click",".rewa",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        var ids = current_object.attr('id');
        console.log('status id new '+ids);
         $("#rewards").modal('show');
        //  $("#stids").vsa('id');
          $("#request_id").val(ids);

        });
        
        
           
 
     var allVals = []; 
     
    $("body").on("click",".sub_chk",function(){
          allVals=[];
       allVals = $(".table input:checkbox:checked").map(function(){
        return $(this).val();
    }).toArray();
    
        console.log('button clicked'+allVals);
    
     });
     
   $("body").on("click",".sub_chk_all",function(){
   $('input:checkbox').not(this).prop('checked', this.checked);
        allVals=[];
                $(".sub_chk:checked").each(function() {  
                    allVals.push($(this).attr('data-id'));
                });  
        console.log('select id is '+allVals);

        });
        
   $("body").on("click",".dropdown-item",function(){
        var current_object = $(this);
        var action = current_object.attr('id');
        var type=current_object.attr('data-id');
        console.log(action+type+allVals);
        var url;
        var msg;
        
        if(type=="offer"){ url='/offer/action';}
        if(type=="offerwall"){ url='/offerwall/action';}

        if(action=="enable"){ msg="Update Succesfully !!"}
        else if(action=="disable"){ msg="Update Succesfully !!"}

        var join_selected_values = allVals.join(",");
        if(allVals==""){
            swal("Please Select at Least one Row !!");
        }else{
             swal({
                title: "Are you sure?",
                text: "Do you really want to Perform this action?",
                icon: "warning",
                buttons: ["Cancel", "Proceed"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data:{
                            id:join_selected_values,
                            type:type,
                            status:action
                        },
                        
                        success: function (data) {
                          if(data==1){
                            location.reload();
                            swal({
                                title: msg,
                                text: "Action Performed!",
                                icon: "success",
                            });
                        }else{
                          swal({
                                title: "Error",
                                text: "Action Not Performed !!",
                                icon: "danger",
                            });   
                        }
                        },
                      });
                } else {
                    swal("Action Not Performed !!");
                }
            });
        }
       

    });
     

})(jQuery);