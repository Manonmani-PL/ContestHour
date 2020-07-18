<?php $this->load->view('front/include/left_side_menu_client'); ?>
  <div class="col-sm-9">
    <div class="right-border">
    	<div class="col-sm-1"></div>
        <div class="col-sm-8">
        	<div class="c_h">
            	<h3>Change Password</h3>
				<?php 
				 echo $this->session->flashdata('message_name');
				 ?>
            	<form action="<?php echo base_url(); ?>admin/save_password_client" method="post" id="form_submit" name="change-password">
				<input type="hidden" id="userid" name="userid" value="<?php echo $userid; ?>" >
                	<table width="100%" cellpadding="5" cellspacing="15">
                    	<tr>
                        <td width="30%"><div align="right"><label>Old Password</label></div></td>
                        <td width="70%"><div align="left"><input type="password" name="oldpassword" id="oldpassword" class="c_h_p" /></div><div id="error-oldpassword" class='form-error error-oldpassword'></div></td>
                        </tr>
                        <tr>
                        <td width="30%"><div align="right"><label>New Password</label></div></td>
                        <td width="70%"><div align="left"><input type="password" name="newpassword" id="newpassword" class="o_l_p" /></div><div id="error-newpassword" class='form-error error-newpassword'></div></td>
                        </tr>
                        <tr>
                        <td width="30%"><div align="right"><label>Confirm Password</label></div></td>
                        <td width="70%"><div align="left"><input type="password" name="confirmpassword" id="confirmpassword" class="o_l_p" /></div><div id="error-confirmpassword" class='form-error error-confirmpassword'></div></td>
                        </tr>
                        <tr>
                        <td width="30%"></td>
                        <td width="70%"><div align="right"><input type="submit" value="Update" name="p_update" style="background-color:#713365"/></div></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        
    </div>
    
  </div>
  		
    	
    </div>
</div>
</div>






</div>
<div class="container">
	<div class="col-md-3"></div>
    
    <div class="col-md-3"></div>
    <div class="col-md-3"></div>
</div>
<div class="gap"></div>


<script type="text/javascript">

$(document).ready(function(){ 
 		 
 $("#confirmpassword").blur(function() 
{
	
	
  var type_password = $("#newpassword").val();
 var confirm_password = $("#confirmpassword").val();
 if(type_password != confirm_password ) 
    $("#error-confirmpassword").html('Password does not Matched');  
 else
    $("#error-confirmpassword").html('');   
});


$("#newpassword").blur(function() 
{
 var password_length = $("#newpassword").val().length;

 if( parseInt(password_length) < 6 || parseInt(password_length) > 10 ) 
    $("#error-newpassword").html('Password Length should be within 6 to 10 character');  
 else
    $("#error-newpassword").html('');   
});
 

		  $("#form_submit").submit(function(){		
				var check = true; 
				
				$("input").each(function(){			
					id = $(this).attr("id");
				
					if(($(this).val().trim() == '' || $(this).val() == null) ){
			
						$(".error-"+id).html("This field is required");
						check = false;
					}
				});
				
				var password_length = $("#newpassword").val().length;

 if( parseInt(password_length) < 6 || parseInt(password_length) > 10 )
 {
	 $("#error-newpassword").html('Password Length should be within 6 to 10 character');  
	 check = false;
 }	 
    

var type_password = $("#newpassword").val();
 var confirm_password = $("#confirmpassword").val();
 if(type_password != confirm_password )
 {
	$("#error-confirmpassword").html('Password does not Matched'); 
	check = false;
 }	 
    

				if(check == false)
				{
					
					return false;
				}
			
		  });
		  
		  $("input").change(function(){
		
		$("input").each(function(){
			
				id = $(this).attr("id");
				
				if($(this).val() != ''){
					$(".error-"+id).html("");
				
					
				}
			});
			}); 
			
	 });
	 
</script>
 <style>
.form-error{
	color:red;
}
</style> 
