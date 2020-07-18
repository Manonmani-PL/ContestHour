<br><br><br><br>
<div class="gap"></div>
<?php
if($this->session->flashdata('msg')){
            echo ' <div class="alert alert-danger " style="width:40%; margin:auto;">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   Invalid Username or password.
                  </div>';
             }
			 if($this->session->flashdata('message')){ echo $this->session->flashdata('message');}
			 if($this->session->flashdata('login_required')){ echo $this->session->flashdata('login_required');}
			 if($this->session->flashdata('client_login_required')){ echo $this->session->flashdata('client_login_required');}
			 if($this->session->flashdata('designer_login_required')){ echo $this->session->flashdata('designer_login_required');}
?>
<br>
<div class="clearfix"></div>
<section>
<div class="container" style="background-color:#f4f2ed;">
<div class="users-login" >Please sign in</div>
</div>
</section>
<!---form---->

<div class="container" style="border:1px solid rgba(0,0,0,0.1)" >
	<div class="row" >
    	<div class="col-md-4 col-lg-4">
        	<a href="<?php echo base_url(); ?>admin/clientSignup"><div class="client-reg">
            	<div class="c-img"><img class="noimgshawdow" src="<?php echo base_url(); ?>assets/images/client-signup.png" /></div>
                <p class="signup_client">Sign up as Client</p>
            </div></a>
        </div>
        <div class="col-md-4 col-lg-4">
        	<div class="user-login">
            	<form action="<?php echo base_url();?>admin/check_login" method="post" name="user">
                <table width="100%" cellpadding="5" border="0" cellspacing="5">
                <tr>
                <td><input type="email" name="u_email" id="u_email" placeholder="E-mail" required="required" /></td>
                </tr>
                <tr>
                <td><input type="password" name="u_password" id="u_password" placeholder="Password" required="required" /></td>
                </tr>
                <tr>
                <td><input type="checkbox" name="u_check" id="u_check" /><span>&nbsp; Remember me</span></td>
                </tr>
                <!--<input type="hidden" name="return_url" value="<?php #echo $return_url; ?>" />-->
                <tr>
                <td><input type="submit" value="sign in" name="u-submit" /></td>
                </tr>
                <tr>
                <td><span><a href="<?php echo base_url(); ?>Admin/forgetpwd">Forgot Password</a></span></td>
                </table>
                </form>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
        	<a href="<?php echo base_url();?>admin/designerSignup"><div class="designer-signup">
            	<div class="design-img"><img class="noimgshawdow" src="<?php echo base_url();?>assets/images/designer-signup.png" /></div>
                <p class="signup_deisgner">Sign up as Designer</p>
            </div></a>
        </div>
    </div>
</div>

<!--close-form--->
<div class="gap"></div>