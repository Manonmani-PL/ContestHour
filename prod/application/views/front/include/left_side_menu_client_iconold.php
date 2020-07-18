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
    <div class="sidebar-nav">
      <div class="navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="visible-xs navbar-brand">catagories</span>
        </div>
		<?php $method= $this->router->fetch_method();?>
		
        <div class="navbar-collapse collapse sidebar-navbar-collapse" style="padding:0px;">
        	<div class="left-navigation"  style="padding:0px;">  
			<li class="<?php echo $method=='myprofile_client'?"active1":"";?>">
				<i class="fa fa-user" style="font-size:  16px;color: #f14b15;"></i>
				<a href="<?php echo base_url();?>admin/myprofile_client">My profile</a>
			</li>
			<?php $user_id = $this->session->userdata('user_id'); ?>
            <li class="<?php echo $method=='message_client'?"active1":"";?>">
				<img src="<?php echo base_url();?>assets/image/message-icon.png" />&nbsp;
				<i class="fa fa-envelope" style="font-size:  16px;color: #f14b15;"></i>
				<a href="<?php echo base_url();?>admin/message_client">Messages</a>
				<span><?php if(messagecount($user_id) > 0){ ?>(<?php echo messagecount($user_id); ?>)<?php } ?></span>
			</li>
            <li class="<?php echo $method=='client_notification'?"active1":"";?>">
				<img src="<?php echo base_url();?>assets/image/message-icon.png" />&nbsp;
				<a href="<?php echo base_url();?>admin/client_notification">Notifications</a>
				<span><?php if(notificationcount($user_id) > 0){ ?>(<?php echo notificationcount($user_id); ?>)<?php } ?></span>
			</li>
            <li class="<?php echo $method=='mycontest_client'?"active1":"";?>">
				<img src="<?php echo base_url();?>assets/image/mycontest-icon.png" />&nbsp;
				<a href="<?php echo base_url();?>admin/mycontest_client">My Contest</a>
				<!--<span><?php if(client_contest_count($user_id) > 0){ ?>(<?php echo client_contest_count($user_id); ?>)<?php } ?></span>-->
			</li>
            <li class="<?php echo $method=='mylivecontest_client'?"active1":"";?>">
				<img src="<?php echo base_url();?>assets/image/live-chat.png" />&nbsp;
				<a href="<?php echo base_url();?>admin/mylivecontest_client">My Live Contest</a>
				<span><?php if(client_livecontest($user_id) > 0){ ?>(<?php echo client_livecontest($user_id); ?>)<?php } ?></span>
			</li>
            <li class="<?php echo $method=='in_judgging'?"active1":"";?>">
				<img src="<?php echo base_url();?>assets/image/judging.png" />&nbsp;
				<a href="<?php echo base_url();?>admin/in_judgging">In Judging</a>
				<span><?php if(client_judgingcontest($user_id) > 0){ ?>(<?php echo client_judgingcontest($user_id); ?>)<?php } ?></span>
			</li>
            <li class="<?php echo $method=='draft_client'?"active1":"";?>">
				<img src="<?php echo base_url();?>assets/image/draft-icon.png" />&nbsp;
				<a href="<?php echo base_url();?>admin/draft_client">Draft</a>
			</li>
            <li class="<?php echo $method=='mycompleted_client'?"active1":"";?>">
				<img src="<?php echo base_url();?>assets/image/completed-icon.png" />&nbsp;
				<a href="<?php echo base_url();?>admin/mycompleted_client">My Completed</a>
			</li>
            <li class="<?php echo $method=='contact_support'?"active1":"";?>">
				<img src="<?php echo base_url();?>assets/image/draft-icon.png" />&nbsp;
				<a href="<?php echo base_url();?>admin/contact_support">Contact Support</a>
			</li>
        </div>  
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>