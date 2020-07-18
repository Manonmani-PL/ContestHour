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
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>	
          </button>
          <span class="visible-xs navbar-brand">Menu</span>
        </div>
		<?php $method= $this->router->fetch_method();?>
		
        <div class="navbar-collapse collapse sidebar-navbar-collapse" style="padding:0px;">
        	<div class="left-navigation"  style="padding:0px;">  
			<li class="<?php echo $method=='myprofile_client'?"active1":"";?>">
				<i class="fa fa-user"></i>
				<a href="<?php echo base_url();?>admin/myprofile_client">My profile</a>
			</li>
			<?php $user_id = $this->session->userdata('user_id'); ?>
            <li class="<?php echo $method=='message_client'?"active1":"";?>">
				<i class="fa fa-envelope"></i>
				<a href="<?php echo base_url();?>admin/message_client">Messages</a>
				<?php if(messagecount($user_id) > 0){ ?><span><?php echo messagecount($user_id); ?></span><?php } ?>
			</li>
            <li class="<?php echo $method=='client_notification'?"active1":"";?>">
				<i class="fa fa-bell"></i>
				<a href="<?php echo base_url();?>admin/client_notification">Notifications</a>
				<?php if(notificationcount($user_id) > 0){ ?><span><?php echo notificationcount($user_id); ?></span><?php } ?>
			</li>
            <li class="<?php echo $method=='mycontest_client'?"active1":"";?>">
				<i class="fa fa-tasks"></i>
				<a href="<?php echo base_url();?>admin/mycontest_client">My Contest</a>
				<!--<?php if(client_contest_count($user_id) > 0){ ?><span><?php echo client_contest_count($user_id); ?></span><?php } ?>-->
			</li>
            <li class="<?php echo $method=='mylivecontest_client'?"active1":"";?>">
				<i class="fa fa-tachometer"></i>
				<a href="<?php echo base_url();?>admin/mylivecontest_client">My Live Contest</a>
				<?php if(client_livecontest($user_id) > 0){ ?><span><?php echo client_livecontest($user_id); ?></span><?php } ?>
			</li>
            <li class="<?php echo $method=='in_judgging'?"active1":"";?>">
				<i class="fa fa-legal"></i>
				<a href="<?php echo base_url();?>admin/in_judgging">In Judging</a>
				<?php if(client_judgingcontest($user_id) > 0){ ?><span><?php echo client_judgingcontest($user_id); ?></span><?php } ?>
			</li>
            <li class="<?php echo $method=='draft_client'?"active1":"";?>">
				<i class="fa fa-bookmark"></i>
				<a href="<?php echo base_url();?>admin/draft_client">Draft</a>
				<?php if(client_draftcontest($user_id) > 0){ ?><span><?php echo client_draftcontest($user_id); ?></span><?php } ?>
			</li>
            <li class="<?php echo $method=='mycompleted_client'?"active1":"";?>">
				<i class="fa fa-trophy"></i>
				<a href="<?php echo base_url();?>admin/mycompleted_client">My Completed</a>
			</li>
            <li class="<?php echo $method=='contact_support'?"active1":"";?>">
				<i class="fa fa-support"></i>
				<a href="<?php echo base_url();?>admin/contact_support">Contact Support</a>
			</li>
		    </div>  
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>