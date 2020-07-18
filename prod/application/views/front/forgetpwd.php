<?php


 if($this->session->flashdata('message')){ echo $this->session->flashdata('message');}
 
?>
<div class="gap"></div>

<section>
<div class="container" style="background-color:#f4f2ed;">
<div class="users-login" >Forgot Password</div>
</div>
</section>
<!---form---->

<div class="container" style="border:1px solid rgba(0,0,0,0.1)" >
	<div class="row"  >
    	<div class="col-md-3 col-lg-3">
		</div>
        <div class="col-md-6 col-lg-6">
        	<div class="client-signup">
            	<form action="<?php echo base_url(); ?>Admin/forgetpwd" method="post" name="client_register_form" id="client_register_form">
                <table width="100%" cellpadding="5" border="0" cellspacing="5">
              
                <tr>
                <td><label>Enter Your Email ID</label></td>
                </tr>
                <tr>
                <td><input required type="email" name="email" id="email" value=""  /></td>
                </tr>
                
                <tr>
                <td><input type="submit" value="Recovery Password" name="c_submit" class="submit" /></td>
                </tr>
                </table>
                </form>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
        
        </div>
    </div>
</div>

<!--close-form--->

<div class="gap"></div>
