 <style>
 .user-login{margin-top:30px;}
.user-login span{font-family:"Roboto", sens-serif; font-size:17px;}
.client-signup{text-align:left; font-size:18px;font-family:"Roboto", sens-serif; padding:30px;}
.client-reg{text-align:center; font-size:18px;font-family:"Roboto", sens-serif; padding:30px;}
.designer-signup{text-align:center; font-size:18px;font-family:"Roboto", sens-serif; margin-top:20px;}
.user-login input[type=password]{ padding:10px 15px; border:none; box-shadow:0 0 1px #888; width:100%;font-family:"Roboto", sens-serif; margin-top:20px;}
.user-login input[type=email]{ padding:10px 15px; border:none; box-shadow:0 0 1px #888; width:100%; font-family:"Roboto", sens-serif; margin-top:6px;}
.user-login input[type=checkbox]{ border:none; box-shadow:0 0 1px #888;  font-family:'inherit'; margin-top:20px;}
.user-login input[type=submit]{ padding:5px 20px; color:#fff; text-transform:uppercase; background-color:#60605f; border:3px solid #60605f; border-radius:4px; font-family:'inherit'; font-size:16px; width:100%; margin-top:9px;}
.user-login input[type=submit]:hover{transition:0.5s linear; box-shadow:0 0px 5px 0 rgba(0,0,0,0.5); background-color:#60605f;}
.users-login{padding:10px;font-family:"Roboto", sens-serif; font-size:20px; font-weight:bold; color:#534741;}
 </style>
 <main id="main" class="non-intro">
<section id="contests-designs">
      <div class="container" >
<div class="col-lg-12 section-header">
				PLEASE SIGN IN
			</div><br>
		<div class="row">
		<div class="col-lg-4">

		<a href="<?php echo base_url(); ?>admin/clientSignup"><div class="client-reg">
                <div class="c-img"><img class="noimgshawdow" src="<?php echo base_url(); ?>assets/images/client-signup.png" /></div>
                <p class="signup_client">Sign up as Client</p>
            </div></a>

		</div>

		<div class="col-lg-4">
			<div class="user-login">
                <form action="<?php echo base_url();?>admin/check_login" method="post" name="user">
                <table width="100%" cellpadding="5" border="0" cellspacing="5">
                <tr>
                <td><input type="email" class="form-control" name="u_email" id="u_email" placeholder="E-mail" required="required" /></td>
                </tr>
                <tr>
                <td><input type="password" class="form-control" name="u_password" id="u_password" placeholder="Password" required="required" /></td>
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
                </table><br>
                </form>
            </div>
		</div>

		<div class="col-lg-4">
			<a href="<?php echo base_url();?>admin/designerSignup"><div class="designer-signup">
            	<div class="design-img"><img class="noimgshawdow" src="<?php echo base_url();?>assets/images/designer-signup.png" /></div>
                <p class="signup_deisgner">Sign up as Designer</p>
            </div></a><br>
		</div>
		</div>

        <div class="row">
<div class="col-md-4 col-lg-4">
<a href="<?php echo base_url(); ?>admin/referralSignup"><div class="client-reg">
                <div ><img class="noimgshawdow" width=200px; src="<?php echo base_url(); ?>assets/images/referral_icon.png"  /></div>
                <p class="signup_client" style="background: #9b7093 !important;">Sign up as Referral</p>
            </div></a>
            
        </div>
        <div class="col-md-4 col-lg-4">
            
        </div>
        <div class="col-md-4 col-lg-4">
        </div>
</div>     
 </session>
 </main>