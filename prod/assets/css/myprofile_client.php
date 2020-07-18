<style>

@media only screen and (min-width: 600px){	

}

</style>

<?php $this->load->view('front/include/left_side_menu_client'); ?>
<div class="col-sm-9" style="margin: 15px -30px 0px -50px!important;">
<?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
<?php if($this->session->flashdata('valid_error')){ echo $this->session->flashdata('valid_error'); } ?>
   <form action="#" method="post" enctype="multipart/form-data">
      <div class="row right-border" style="border:0px solid red; margin-left: 25px;">
         <div class="col-sm-12 col-xs-12">
			<div class="row">
				<div class="col-md-3 col-lg-3" style="padding-bottom: 15px;">
				   <div class="myprofile_box">
					  <img src="<?php if(!empty($user_details[0]->profile)) {echo base_url();?>uploads/client_profile/<?php echo $user_details[0]->profile;} else { echo base_url();?>assets/images/client-signup.png<?php }?>" class="myprofile_img_client">							
				   </div>
				</div>
				 <section id="contests-designs">
				<div class="col-md-9 col-lg-9">
				   <span style="background:#9b7093;padding:10px;margin:0px;font-weight:bold;text-transform:uppercase;" class="section-header">
				   <?php echo $user_details[0]->user_name; ?>
				   </span>
				   <span style="margin-left:0px;color: #4c2670;font-weight:bold;">
				   Email : <?php echo $user_details[0]->user_email; ?>
				   </span>
				   <div style="background:#f2f2f2;padding:10px;min-height: 150px;width: 100%;margin-top:0px;display:table;line-height:22px;">
					  <span style="display:table;"><b>About Me</b></span>
					  <p><?php echo $user_details[0]->intro; ?></p>
				   </div>
				</div>
			</section>
            </div>
			<div class="row">
				<div class="col-md-8 col-lg-8">
				   <span style="background:#f2f2f2;padding:10px;margin:0px;font-weight:bold;text-transform:uppercase;display:table;margin-top:3px;width:36.5%;">
				   COUNTRY : <?php echo country_name($user_details[0]->user_country);?>
				   </span>
				   <ul style="list-style-type:none;line-height:32px;margin:0px;padding:0px;font-size:16px;">
					  <li><i class="fa fa-arrow-circle-right"></i> <?php echo client_contest_count($user_details[0]->user_id);?> Contests Posted </li>
					  <!--<li><i class="fa fa-clock-o"></i> Last Login 3 Hours, 50 Minutes ago</li>-->
					  <li><i class="fa fa-clock-o" aria-hidden="true"></i></i>
						 Last Login 
						  <?php $last_logged_in=strtotime(last_logged_in($user_details[0]->user_id));
						  echo timespan($last_logged_in, time()) . ' ago';?>
					  </li>
				   </ul>
				</div>
				<div class="col-md-4 col-lg-4">
				   <a style="background:#713365; padding:10px; margin-top:10px; display:table; width:100%; font-size: 18px; color: #fff; text-align: center;" href="<?php echo base_url();?>admin/update_clientinfo">Edit Profile</a>
				   <a  style="background:#713365;padding:10px;margin-top:10px;display:table;width:100%;font-size: 18px;color: #fff;text-align: center;" href="<?php echo base_url();?>admin/change_password_client">Change Password</a>
				</div>
			</div>
         </div>
      </div>
   </form>
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