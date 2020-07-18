<style>
a {
  color: #4c2670;
  transition: 0.5s;
}
a:hover, a:active, a:focus {
  color: #4c2670;
  outline: none;
  text-decoration: none;
}
</style>
<div class="gap-low"></div>
<div class="minheight">
<div class="container">
<div class="row">
<div class="col-sm-3">
   <div class="sidebar-nav profile-menu">
      <div class="navbar-default" role="navigation">
         <div class="navbar-header"> <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <?php  
            $user_id=$this->session->userdata('user_id'); 
            $ref_id = get_referral_id($user_id);
         	if($ref_id==""){
         	 ?>
            </button> <span class="visible-xs navbar-brand">Catagories</span> 
        	<?php } else { ?>
        	</button> <span class="visible-xs navbar-brand">Menu</span>
        <?php } ?>
         </div>
		 <?php 
			$user_id = $this->session->userdata('user_id');
			$method= $this->router->fetch_method();
		 ?>
         <div class="navbar-collapse collapse sidebar-navbar-collapse" style="padding:0px;">
         	<?php  $ref_id = get_referral_id($user_id);
         	if($ref_id==""){
         	 ?>
            <div class="left-navigation">
               <li class="<?php echo $method=='myprofile_designer'?"active1":"";?>">
				   <i class="fa fa-user" ></i>
				   <a href="<?php echo base_url();?>admin/myprofile_designer">My profile</a>
			   </li>
               <li class="<?php echo $method=='message_designer'?"active1":"";?>">
				   <i class="fa fa-envelope"></i>
				   <a href="<?php echo base_url();?>admin/message_designer">Messages</a>
				   <?php if(messagecount($user_id) > 0){ ?><span><?php echo messagecount($user_id); ?></span><?php } ?>
			   </li>
				<li class="<?php echo $method=='designer_notification'?"active1":"";?>">
					<i class="fa fa-bell"></i>
					<a href="<?php echo base_url();?>admin/designer_notification">Notifications</a>
					<?php if(notificationcount($user_id) > 0){ ?><span><?php echo notificationcount($user_id); ?></span><?php } ?>
				</li>
               <li class="<?php echo $method=='payment_designer'?"active1":"";?>">
				   <i class="fa fa-usd"></i>
				   <a href="<?php echo base_url();?>admin/payment_designer">Payment</a>
			   </li>
               <li class="<?php echo $method=='joined_designer'?"active1":"";?>">
				   <i class="fa fa-anchor"></i>
				   <a href="<?php echo base_url();?>admin/joined_designer">Joined</a>
			   </li>
               <li class="<?php echo $method=='finalist_designer'?"active1":"";?>">
				   <i class="fa fa-asterisk"></i>
				   <a href="<?php echo base_url();?>admin/finalist_designer">Finalist</a>
			   </li>
               <!--<li class="<?php echo $method=='invited_designer'?"active1":"";?>">
				   <img src="<?php echo base_url();?>assets/image/invited_icon.png" />&nbsp;
				   <a href="<?php echo base_url();?>admin/invited_designer">Invited</a>
			   </li>-->
               <li class="<?php echo $method=='winning_designer'?"active1":"";?>">
				   <i class="fa fa-trophy"></i>
				   <a href="<?php echo base_url();?>admin/winning_designer">Winning</a>
			   </li>
			   <!--
               <li class="<?php echo $method=='taggled_designer'?"active1":"";?>">
				   <img src="<?php echo base_url();?>assets/image/toggle_icon.png" />&nbsp;
				   <a href="<?php echo base_url();?>admin/taggled_designer">Tagged</a>
			   </li>-->
               <li class="<?php echo $method=='myprofile_designerportfolio'?"active1":"";?>">
				   <i class="fa fa-gift"></i>
				   <a href="<?php echo base_url();?>admin/myprofile_designerportfolio">Portfolio</a>
			   </li>
			  <!--  <li class="<?php echo $method=='referral_code'?"active1":"";?>">
				   <i class="fa fa-support"></i>
				   <a href="<?php// echo base_url();?>admin/designer_referral_code">Designer Referral Code</a>
			   </li> -->
            </div>
              <?php } else { ?> 
        	 <div class="left-navigation">
               <li class="<?php echo $method=='myprofile_referral'?"active1":"";?>">
				   <i class="fa fa-user" ></i>
				   <a href="<?php echo base_url();?>admin/myprofile_referral">My profile</a>
			   </li>

			      <li class="<?php echo $method=='payment_referral'?"active1":"";?>">
				   <i class="fa fa-usd"></i>
				   <a href="<?php echo base_url();?>admin/payment_referral">Request Payout</a>
			   </li>
			        <li class="<?php echo $method=='new_referral_details'?"active1":"";?>">
				   <i class="fa fa-usd"></i>
				   <a href="<?php echo base_url();?>admin/new_referral_details">Payment Details</a>
			   </li>
			</div>

        <?php } ?>
         </div>
         <!--/.nav-collapse -->
      </div>
   </div>
</div>