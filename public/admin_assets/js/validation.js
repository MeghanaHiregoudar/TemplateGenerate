
$(document).ready(function(){
   // alert("load");
    
    
    $("#login_form").submit(function(e){
        e.preventDefault();
        
        var login_email = $("#login_email").val();
        var login_password = $("#login_password").val();
        var error = 0;
        
        if(login_email == "")
        {
            $("#error_login_email").text("Please enter email-Id");
            error++;
        }
        else
        {
            $("#error_login_email").empty();
        }
        if(login_password == "")
        {
            $("#error_login_password").text("Please enter password");
            error++;
        }
        else
        {
            $("#error_login_password").empty();
        }
        		      if(error>0)
      {
        return false;
      }
                 
      else
        { 
           
            $("#login_btn").attr("disabled",true);
            $.ajax({
          url:$("#login_form").attr("action"),
          type:"POST",
          dataType:"JSON",
          data:$("#login_form").serialize(),
          success:function(response){
               
               $("#login_btn").attr("disabled",false);
              
               $.notify({
                // options
                message: response.msg 
              },{
                // settings
                type: response.status
              });
            window.setTimeout(function(){ window.location.href =response.redirect   },500);
  
          },
          error:function(e1,e2,e3){
               alert("Problem In Processing Your Request"+e3);
          },
      });
  } 
    }); 
    
    /************** Login code ends here **************/
    
	var user_list_url = $("#user_list_url").val();
	var user_table = $("#user_table").DataTable({
		processing: true,
		serverSide: true,
		//"order": [[ 0, "asc" ]],
		ajax: user_list_url,
		
		columns: [
			{data: 'rownum', name: 'rownum'},
			{data: 'first_name', name: 'first_name'},
			{data: 'last_name', name: 'last_name'},
			{data: 'mobile', name: 'mobile'},
			{data: 'email', name: 'email'},
			{data: 'Action', name: 'Action',orderable:false,serachable:false},
		]
	}); //end of datatable

	

	$('#create_user_form').submit(function(e){
		e.preventDefault();
		
		var first_name	= $("#first_name").val();
		var last_name	= $("#last_name").val();
		var mobile		= $("#mobile").val();
		var email		= $("#email").val();
		var password 	= $("#password").val();
		var re_password = $("#re_password").val();
		var roles	= $("#roles").val();
		
		var error=0;
           
		if (first_name == "")
		{
			$("#error_first_name").text("Please provide First name");
			error++;
		}
		else
		{
			$("#error_first_name").empty();
			
		}
		if (last_name == "")
		{
			$("#error_last_name").text("Please provide Last name");
			error++;
		}
		else
		{
			$("#error_last_name").empty();
		}
		if (mobile == "")
		{
			$("#error_mobile").text("Please provide mobile number");
			error++;
		}
		else if(mobile.length !=10)
		{
			$("#error_mobile").text("Please provide 10 digit mobile number");
			error++;
		}

		else
		{
			$("#error_mobile").empty();
		}
		if (email == "")
		{
			$("#error_email").text("Please provide Email-Id");
			error++;
		}
		else
		{
			$("#error_email").empty();
		}
		if (password == "")
		{
			$("#error_password").text("Please enter password");
			error++;
		}
		else
		{
			$("#error_password").empty();
		}
		if (re_password == "")
		{
			$("#error_re_password").text("Please Confirm password");
			error++;
		}
		else
		{
			$("#error_re_password").empty();
		}
		if (password != re_password)
		{
			$("#error_match_password").text("Password did not match");
			error++;
		}
		else
		{
			$("#error_match_password").empty();
		}
		
		if (roles == "")
		{
			$("#error_roles").text("Please Select Roles");
			error++;
		}
		else
		{
			$("#error_roles").empty();
			
		}

		      if(error>0)
      {
        return false;
      }
                 
      else
        { 
           // alert('updated successfully');
            $.ajax({
          url:$("#create_user_form").attr("action"),
          type:"POST",
          dataType:"JSON",
          data:$("#create_user_form").serialize(),
          success:function(response){
              // alert(response)
               $("#user_submit_btn").attr("disabled",false);
  
               $(".loader").addClass("d-none");
               $(".loader").removeClass("d-block");
  
              $.notify({
                // options
                message: response.msg 
              },{
                // settings
                type: response.status
              });
  
              window.setTimeout(function(){ window.location.href = " " },1000);
  
          },
          error:function(e1,e2,e3){
               alert("Problem In Processing Your Request"+e3);
          },
      });
  
      
  } 
	});
    
    // Edit of User Form starts
      	$('#update_user_form').submit(function(e){
		e.preventDefault();
		
		var first_name	= $("#first_name").val();
		var last_name	= $("#last_name").val();
		var mobile		= $("#mobile").val();
		var email		= $("#email").val();
		var password 	= $("#password").val();
		var re_password = $("#re_password").val();
		var error=0;

		if (first_name == "")
		{
			$("#error_first_name").text("Please provide First name");
			error++;
		}
		else
		{
			$("#error_first_name").empty();
			
		}
		if (last_name == "")
		{
			$("#error_last_name").text("Please provide Last name");
			error++;
		}
		else
		{
			$("#error_last_name").empty();
		}
		if (mobile == "")
		{
			$("#error_mobile").text("Please provide mobile number");
			error++;
		}
		else if(mobile.length !=10)
		{
			$("#error_mobile").text("Please provide 10 digit mobile number");
			error++;
		}

		else
		{
			$("#error_mobile").empty();
		}
		if (email == "")
		{
			$("#error_email").text("Please provide Email-Id");
			error++;
		}
		else
		{
			$("#error_email").empty();
		}
		if (password == "")
		{
			$("#error_password").text("Please enter password");
			error++;
		}
		else
		{
			$("#error_password").empty();
		}
		if (re_password == "")
		{
			$("#error_re_password").text("Please re-enter password");
			error++;
		}
		else
		{
			$("#error_re_password").empty();
		}
		if (password != re_password)
		{
			$("#error_match_password").text("Password did not match");
			error++;
		}
		else
		{
			$("#error_match_password").empty();
		}

		      if(error>0)
      {
        return false;
      }
                 
      else
        {   
             $("#user_update_btn").attr("disabled",true);
            
            $.ajax({
          url:$("#update_user_form").attr("action"),
          type:"POST",
          dataType:"JSON",
          data:$("#update_user_form").serialize(),
          success:function(response){
               
               $("#user_update_btn").attr("disabled",false);
  
               $(".loader").addClass("d-none");
               $(".loader").removeClass("d-block");
  
              $.notify({
                // options
                message: response.edit_msg 
              },{
                // settings
                type: response.status
              });
  
              window.setTimeout(function(){ window.location.href = response.redirect },1000);
  
          },
          error:function(e1,e2,e3){
               alert("Problem In Processing Your Request"+e3);
          },
      });
  
      
  } 
	});
    // Edit Of User Form Ends 
    
    $(document).on('click','#user_delete',function() {
      	//e.preventDefault();
      	
       var id = $(this).data('id');
       var url = $("#user_table").data("delete_url");
       var token = $('meta[name="csrf-token"]').attr('content');
       $.ajax({
           url:url,
           method:"PUT",
           data: {
               id:id,
               _token:token
           },
            success:function(response)
            {
               	$.notify({
					// options
					message: response.msg 
					},{
					// settings
					type: response.status
				});
		
				window.setTimeout(function(){ window.location.href = response.redirect },1000); 	
            }
           
       }); //End of ajax
    
    });
    
    /************************User Code Ends here*************************** */ 



	/************************Letter Type Code Start here*************************** */ 

	$letter_type_table = $("#letter_type_list").DataTable({
		serachable:true,
		dom:  "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
			  "<'row'<'col-sm-12'tr>>" +
			  "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		buttons: [
			'excelHtml5',
			'pdfHtml5'
		],
	});
	
	//Check or Uncheck all checkboxes
	$('#select_all').on('click',function(){
        if(this.checked){
            $('.field_ckeckbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.field_ckeckbox').each(function(){
                this.checked = false;
            });
        }
    });
	
	//changing state of select_all checkbox
	$('.field_ckeckbox').on('click',function(){
        if($('.field_ckeckbox:checked').length == $('.field_ckeckbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });

	$("#letter_type_add").submit(function(e){
		e.preventDefault();
		var letter_type = $("#letter_type").val();
		var field_id = $("#field_id");
		var error = 0;
		
		if(letter_type == "")
		{
			$("#error_letter_type").text("Please Enter The Template Name");
			error++;
		}
		else
		{
		 	$("#error_letter_type").empty();
		}

		if(error>0)
		{
		  return false;
		}		   
		else
		{   
			$("#letter_type_btn").attr("disabled",true);
			  
			$.ajax({
				url:$("#letter_type_add").attr("action"),
				type:"POST",
				data:$("#letter_type_add").serialize(),
				success:function(response){
              		$("#letter_type_btn").attr("disabled",false);
					$.notify({
					// options
					message: response.msg_field 
					},{
					// settings
					type: response.status
					});
		
					window.setTimeout(function(){ window.location.href = response.redirect },1000);
				}
			}); //End of ajax
		}
	});//end of letter type add

	$("#letter_type_update").submit(function(e){
		e.preventDefault();
		var letter_type = $("#letter_type").val();
		var field_id = $("#field_id");
		var error = 0;
		
		if(letter_type == "")
		{
			$("#error_letter_type").text("Please Enter The Template Name");
			error++;
		}
		else
		{
		 	$("#error_letter_type").empty();
		}

		if(error>0)
		{
		  return false;
		}		   
		else
		{   
			$("#letter_type_update_btn").attr("disabled",true);
			$.ajax({
				url:$("#letter_type_update").attr("action"),
				method:"PUT",
				data:$("#letter_type_update").serialize(),
				success:function(response){
              		$("#letter_type_update_btn").attr("disabled",false);
					$.notify({
					// options
					message: response.msg_field 
					},{
					// settings
					type: response.status
					});
		
					window.setTimeout(function(){ window.location.href = response.redirect },1000);
				}
			}); //End of ajax
		}
	});//end of letter type update


	$(document).on("click","#letter_type_delete",function(e){
		e.preventDefault();
		var id = $(this).data('delete_id');
		var token = $('meta[name="csrf-token"]').attr('content');
		if(confirm('Are you sure?')) 
        { 
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url : $("#letter_type_list").data('delete_url'),
				method:"PUT",
				data : {
					id:id,
					_token:token
				},
				success:function(response){
					$.notify({
					// options
					message: response.msg_field 
					},{
					// settings
					type: response.status
					});
		
					window.setTimeout(function(){ window.location.href = response.redirect },1000);
				}
			}); //End of ajax
		}
	}); //End of letter_type_delete
	
	
	$("#letterType_body").submit(function(e){
		e.preventDefault();
		save_LetterBody();
	});
/************************Letter Type Code Ends here*************************** */ 
    
    
/************************New Field Code Ends here*************************** */ 
	//New Field Add form  Validation starts
	
	$("#new_template_form").submit(function(e){
		e.preventDefault();
		var field = $("#field_name").val();
		var field_name = $("#field_type").val();
		var error = 0;

		if(field == "")
		{
			$("#error_field").text("Please enter the name of the field");
			error++;
		}
		else
		{
		 	$("#error_field").empty();
		}
		if(field_name == "")
		{
			$("#error_field_name").text("Please select any of the field type");
			error++;
		}
		else
		{
			$("#error_field_name").empty();
		}
		
		if(error>0)
        {
            return false;
        }
        else
        {   
             $("#tamplate_create").attr("disabled",true);
            
            $.ajax({
              url:$("#new_template_form").attr("action"),
              type:"POST",
              dataType:"JSON",
              data:$("#new_template_form").serialize(),
              success:function(response){
              
                   $("#tamplate_create").attr("disabled",false);
      
                   $(".loader").addClass("d-none");
                   $(".loader").removeClass("d-block");
  
                  $.notify({
                    // options
                    message: response.msg_field 
                  },{
                    // settings
                    type: response.status
                  });
  
                    window.setTimeout(function(){ window.location.href = " " },1000);
                },
                error:function(e1,e2,e3){
                    alert("Problem In Processing Your Request"+e3);
                }
            }); //End of ajax
        } 
	});
   //new Field Add form  Validation Ends
  
    //Field update Validation starts
     
	$("#edit_template").submit(function(e){
		e.preventDefault();
		var field = $("#field").val();
		var field_name = $("#field_name").val();
		var error = 0;

		if(field == "")
		{
			$("#error_field").text("Please enter the name of the field");
			error++;
		}
		else
		{
		 	$("#error_field").empty();
		}
		if(field_name == "")
		{
			$("#error_field_name").text("Please select any of the field name");
			error++;
		}
		else
		{
			$("#error_field_name").empty();
		}
		
		      if(error>0)
      {
        return false;
      }
                 
      else
        {   
             $("#tamplate_update_btn").attr("disabled",true);
            
            $.ajax({
          url:$("#edit_template").attr("action"),
          type:"POST",
          dataType:"JSON",
          data:$("#edit_template").serialize(),
          success:function(response){
              
               $("#tamplate_update_btn").attr("disabled",false);
  
               $(".loader").addClass("d-none");
               $(".loader").removeClass("d-block");
  
              $.notify({
                // options
                message: response.edit_field_msg 
              },{
                // settings
                type: response.status
              });
  
              window.setTimeout(function(){ window.location.href = response.redirect },1000); 	
  
          },
          error:function(e1,e2,e3){
               alert("Problem In Processing Your Request"+e3);
          },
      });
  } 
	});
  //Field update Validation Ends
  
//Field  Delete starts 
$(document).on('click','#field_delete',function() {
      	//e.preventDefault();
    //   	alert("working");
       var id = $(this).data('id');
       var url = $("#field_list").data("delete_url");
       var token = $('meta[name="csrf-token"]').attr('content');
       
       $.ajax({
           url:url,
           method:"PUT",
           data: {
               id:id,
               _token:token
           },
            success:function(response)
            {
               	$.notify({
					// options
					message: response.msg 
					},{
					// settings
					type: response.status
				});
		
				window.setTimeout(function(){ window.location.href = response.redirect },1000); 	
            }
           
       }); //End of ajax
    
    })

//Field  Delete Ends

//Field List starts
	var field_list_url = $("#field_list_url").val();
	var field_list_table = $("#field_list").DataTable({
		processing: true,
		serverSide: true,
		// scrollX: true,
		"order": [[ 0, "asc" ]],
		ajax: field_list_url,
		dom:  "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
			  "<'row'<'col-sm-12'tr>>" +
			  "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		buttons: [
			'excelHtml5',
			'pdfHtml5'
		],
		columns: [
		    {data: 'rownum', name: 'rownum'},
			{data: 'field_name', name: 'field_name'},
			{data: 'field_type', name: 'field_type'},
			{data: 'short_name', name: 'short_name'},
			{data: 'Action', name: 'Action',orderable:false,serachable:false},
		]
	});//End of datatable
//fields list ends here

/************************New Field Code Ends here*************************** */ 



/***********************Template Report Code starts here*************************** */ 

    /*Template fromDate and Todate Date format*/
    $('#from_date').datepicker({
        format: "dd-mm-yyyy",
        changeMonth: true,
        changeYear: true,    
    });
    
    $('#to_date').datepicker({
        format: "dd-mm-yyyy",
           changeMonth: true,
           changeYear: true,
    });
    
    //To set for dynamic date fields
    $(".field_class").prop('type', 'text');
    
    $('.field_class').datepicker({
        format: "dd-mm-yyyy",
          changeMonth: true,
          changeYear: true,
    });
 	/*Genarate Template Report code Start*/
		
	$("#template_report_form").submit(function(e){
		e.preventDefault();
		//alert("work");
		var from_date = $("#from_date").val();
		var to_date = $("#to_date").val();
		var error = 0;
		if (from_date == "" || to_date == "")
		{
			$("#date_error").text("Please select the Start and End Date");
			error++;
		}
		else
		{
			$("#date_error").empty();
		}

		if(error == 0)
		{
		    $("#loader_img").removeClass('d-none');
		    
		    $.ajaxSetup({
    		    headers: {
    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			}
		    });
			$.ajax({
				url:$("#template_report_form").attr("action"),
				type:"POST",
				dataType:"JSON",
				data:{from_date:from_date,to_date:to_date},
				success:function(data){
					//console.log(data);
				    $("#loader_img").addClass('d-none');
				    var sl = 1;
               
                $('#report_list').DataTable( {
                    "data" : data,
                    "responsive" : true,
                    "destroy": true,
                    dom: 
                      "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                      "<'row'<'col-sm-12'tr>>" +
                      "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    buttons: [
                       'excel', 'pdf'
                      ],
                    "columns" : [
                        { "render" : function()
                            {
                              return sl++;
                            } 
                        },
                        {"data" : "email"},
                        {"data" : "letter_type"},
                        {"render" : function(data,type,row)
                        {
                            //alert(edit_url+'/'+row.vendor_id);
                            var action = '<button class="btn btn-xs"  data-toggle="tooltip" title="Edit"> <a style="margin-right:10px;"  id="report_edit" data-id="'+row.id+'" data-toggle="modal" data-target="#report_edit_modal" class=" float-left" href="javascript:;"><i class="mdi mdi-table-edit"> </i> </a> </button>'+
                                         '<button class="btn btn-xs " > <a style="margin-right:10px;" data-toggle="tooltip" title="View Pdf" id="report_pdf" target="blank" class=" float-left text-danger" href="'+row.id+'/report_pdf" ><i class="mdi mdi-file-pdf"> </i> </a> </button>'+
                                         '<button class="btn btn-xs " > <a style="margin-right:10px;" data-toggle="tooltip" title="Send Mail" id="report_email" data-id="'+row.id+'" class=" float-left" href="javascript:;" ><i class="mdi mdi-email"> </i> </a> </button>'+
                                         '<button class="btn btn-xs "> <a style="margin-right:10px;" data-toggle="tooltip" title="Delete" id="report_delete" data-id="'+row.id+'" class=" float-left text-danger " href="javascript:;" ><i class="mdi mdi-delete-forever"> </i> </a> </button>';
                            return action;
                        }
                    }
                    ]   
                }); //End of DataTables
						
				}
			}); //End of ajax
		}
	}); //End of submit
	

    //Edit email in template report
	$(document).on("click","#report_edit",function(e){
		e.preventDefault();
		//alert("edit report");
		var id = $(this).data('id');
		$.ajax({
			url: id+"/report_edit",
			method : "GET",
			success: function(result) {
				//alert(result.html);
				$('#report_edit_modal').show();
				$('#EditReportModalBody').html(result.html);
				//$('#report_edit_modal').show();
			}

		}); //end of ajax
	}); //End of report edit
	
	
    //Update email in template report
	$(document).on("click","#SubmitEditForm",function(e){
		e.preventDefault();
		var id = $("#edit_id").val(); 
		var email = $("#edit_email").val();
		var error =0;
		if(email == "")
		{
			$("#error_edit_email").text("Please Enter Email");
			error++;
		}
		else
		{
			$("#error_edit_email").empty();
		}
		if(error == 0)
		{
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url : "report_update",
				method:"PUT",
				data:{
					id:id,
					email:email
				},
				success:function(response)
				{
					console.log(response);
					$('#report_edit_modal').modal('hide');
					$.notify({
						// options
						message: response.field_msg 
					},{
						// settings
						type: response.status
					});
					window.setTimeout(function(){ window.location.href = response.redirect },1000);
				}

			}); //End of ajax

		}
		
	});//End of update

//Send email in template report
	$(document).on("click","#report_email", function(e){
		e.preventDefault();
        $("#loader_img").removeClass('d-none');
		var id = $(this).data("id");
		var url = $("#report_list").data("report_email");
		var token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: url,
			method:"POST",
			data: {
				id:id,
				_token:token
			},
			success:function(response)
			{
				$("#loader_img").addClass("d-none");
				$.notify({
					// options
					message: response.field_msg 
				},{
					// settings
					type: response.status
				});
			}

		}); //End of ajax
	}); //End of report email

//delete template report
	$(document).on("click","#report_delete",function(e){
		e.preventDefault();
		//alert("report_delete");
		var id = $(this).data("id");
		var delete_url = $("#report_list").data("delete_report");
		var token = $('meta[name="csrf-token"]').attr('content');
		//alert(id);
		if(confirm('Are you sure?')) 
        {
			$.ajax({
				url:delete_url,
				method:"PUT",
				data:{
					id:id,
                    _token:token
				},
				success:function(response)
				{
					$.notify({
						// options
						message: response.field_msg 
					},{
						// settings
						type: response.status
					});
	
					window.setTimeout(function(){ window.location.href = response.redirect },1000);
				}
			}); //End of ajax
		}
	});
	
	
	//Autosave generated template
  
   //setInterval(function(){ autoSave(); },1000)

    // var e = CKEDITOR.instances['body_content'];
    // e.document.on('keyup',function() {
    //     alert(e.getData());
    //     alert("kncksdnfjsd");
    //     //autoSave();
    // });
 
    $("#template_body_form").submit(function(e){
        e.preventDefault();
        autoSave();
       window.location.href = $("#refresh_url").val();
    });
/*******************Genarate Template Report code End*******************/

}); //document ends here

//Below function is to template body save
function save_LetterBody()
{
    var id = $("#letter_type_id").val();
		var letter_content = CKEDITOR.instances['letter_content'].getData();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url:$("#letterType_body").attr("action"),
			method:"PATCH",
			data:{
			    id:id,
			    letter_content:letter_content,
			},
			success:function(response){
			}
		});//End of ajax
}



    
    //Below function is for print template
    function autoSave()
    {
        var template_report_id = $("#template_report_id").val();
		var body_content = CKEDITOR.instances['body_content'].getData();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url:$("#template_body_form").attr("action"),
			method:"PATCH",
			data:{
			    template_report_id:template_report_id,
			    body_content:body_content,
			},
			success:function(response){
			   
			}
		});//End of ajax
    }
