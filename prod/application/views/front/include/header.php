
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>ContestHours.com</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="<?php echo base_url();?>assets/images/favicon.png" rel="icon">
  <link href="<?php echo base_url();?>assets/images/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet"> 
  <!-- Bootstrap CSS File 
  <link href="<?php echo base_url();?>assets/bootstrap.min.css" rel="stylesheet">-->
  <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
  

  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url();?>assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/styles.css" rel="stylesheet"> 
   <script type="text/javascript" src="<?php echo base_url();?>assets/jquery.js"></script>
</head>

<body>

  <!--==========================
    Header
  ============================-->
 <header id="header">
    <div class="container"><!-- <div class="container-fluid"> -->
    <div class="row">
      <div id="logo" class="col-md-3">
      <a href="<?php echo base_url();?>">
      <img src="<?php echo base_url();?>assets/images/logo.png" alt="" title="ContestHours.com" class="hidden-mob"/></a>
       <a href="<?php echo base_url();?>">
      <img src="<?php echo base_url();?>assets/images/logo-icon.png" alt="" title="ContestHours.com" class="show-mob"></a>
      <ul class="nav-menu mobile-header-righ">
        <?php 
        $usertype=$this->session->userdata('user_type'); 
        $user_id=$this->session->userdata('user_id'); 
        $username = $this->session->userdata('user_name');
       
         if($username){
      if($usertype == 0){ 
        ?>     
          <li class="show-mob"><a href="#" class="user-btn"><?php  echo substring($username,'7');?> <i class="fa fa-list-ul"></i></a>
             <ul class="logmenu">
                  <li class="show-mob"><a href="<?php echo base_url();?>Admin/myprofile_client"><i class="fa fa-user"></i> My Profile</a></li><br>
                  <li class="show-mob"><a href="<?php echo base_url()?>admin/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
          </li>
        <?php } else { ?>       
          <li><a href="#" class="user-btn"><?php echo substring($username,'7');?> <i class="fa fa-list-ul"></i></a>
             <?php $ref_id = get_referral_id($user_id);
              if($ref_id==""){ ?>
             <ul class="logmenu">
                  <li class="show-mob"><a href="<?php echo base_url();?>Admin/myprofile_designer"><i class="fa fa-user"></i> My Profile</a></li><br>
                  <li class="show-mob"><a href="<?php echo base_url()?>admin/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            <?php } else { ?>
               <ul class="logmenu">
                  <li class="show-mob"><a href="<?php echo base_url();?>Admin/myprofile_referral"><i class="fa fa-user"></i> My Profile</a></li><br>
                  <li class="show-mob"><a href="<?php echo base_url()?>admin/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            <?php } ?>
          </li>
        <?php } }   else { ?>
          <li><a href="<?php echo base_url();?>Admin/loginForm" class="user-btn">Login</a></li>
        <?php   } ?> 

        <li><a href="<?php echo base_url();?>Admin/startnow2" class="start-now" style="background: #fbb03b !important;">Get Now</a></li>
      </ul>
      </div>
      <div class="col-md-3">
      </div>
      <div class="col-md-6 head-top-menu">
      <ul class="nav-menu">
        <?php
          $user_id = $this->session->userdata('user_id'); 
        $notify= notificationcount($user_id);
        if($username){
         if($usertype == 0){
        ?>
          <!-- <li><a href="<?php echo base_url();?>Admin/mycontest_client" class="text-orange"><i class="fa fa-th-large"></i></a></li>
          <li><a href="<?php echo base_url();?>Admin/client_notification" class="text-orange"><i class="fa fa-bell"></i></a></li>
          <li><a href="<?php echo base_url();?>Admin/message_client" class="text-orange"><i class="fa fa-envelope"></i></a></li>    -->         
          <li><a href="#" class="user-btn hidden-mob"><?php echo $username;?> 
              <i class="fa fa-list-ul"></i></a>
             <ul class="logmenu">
                  <li><a href="<?php echo base_url();?>Admin/myprofile_client"><i class="fa fa-user"></i> My Profile</a></li>
                  <li><a href="<?php echo base_url()?>admin/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
          </li>
        <?php } else { ?>
          <li><a href="<?php echo base_url();?>Admin/joined_designer" class="text-orange"><i class="fa fa-th-large hide_referral"></i></a></li>
              <li><a href="<?php echo base_url();?>Admin/designer_notification" class="text-orange">
         <!--    <i class="fa fa-bell hide_referral"></i> -->
             <div class="message-box">
           <div class="msg-icon">
            <?php if($notify > 0){  ?>
              <i class="fa fa-bell hide_referral" style=" font-size: 17px; color: #fbb03b;  margin-left: 5px;"></i>
              <?php } else { ?>
              <i class="fa fa-bell hide_referral" style=" font-size: 17px; color: #fff;  margin-left: 5px;"></i>
              <?php } ?>
            </div>
              <div <?php if($notify > 0){  ?> class="msg-count" <?php } ?> >
            
            <span><?php if($notify > 0){ echo $notify; } ?></span>
            
            </div>
            </div>
          </a></li>
            <li><a href="<?php echo base_url();?>Admin/message_designer" class="text-orange">
            <!-- <i class="fa fa-envelope hide_referral"></i> -->
             <div class="message-box">
           <div class="msg-icon">
            <?php if(messagecount($user_id) > 0){  ?>
              <i class="fa fa-envelope hide_referral" style=" font-size: 17px; color: #fbb03b;  margin-left: 5px;"></i>
              <?php } else { ?>
              <i class="fa fa-envelope hide_referral" style=" font-size: 17px; color: #fff;  margin-left: 5px;"></i>
              <?php } ?>
            </div>
             <div <?php if(messagecount($user_id) > 0){  ?> class="msg-count" <?php } ?> >
            
            <span><?php if(messagecount($user_id) > 0){ echo messagecount($user_id);  } ?></span>
            
            </div>
            </div>
          </a></li>       
          <li><a href="#" class="user-btn hidden-mob"><?php echo $username;?> <i class="fa fa-list-ul"> </i></a>
               <?php 
                $ref_id = get_referral_id($user_id);
              if($ref_id==""){?>
               <ul class="logmenu">
                  <li><a href="<?php echo base_url();?>Admin/myprofile_designer"><i class="fa fa-user"></i> My Profile</a></li>
                  <li><a href="<?php echo base_url()?>admin/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul> 
                <?php } else { ?>
                  <ul class="logmenu">
                  <li><a href="<?php echo base_url();?>Admin/myprofile_referral"><i class="fa fa-user"></i> My Profile</a></li>
                  <li><a href="<?php echo base_url()?>admin/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul> 
                <?php } ?>
            </li>  
         
        <?php } }   else { ?>
          <li><a href="<?php echo base_url();?>Admin/loginForm" class="user-btn hidden-mob">Login</a></li>
        <?php   } ?>
        <li><a href="<?php echo base_url();?>Admin/startnow2" class="start-now hidden-mob">Get Now</a></li>
      </ul>
      </div>
    </div>
      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="<?php echo base_url();?>admin/contestCompleted">Contests</a></li>
          <li><a href="<?php echo base_url();?>admin/portfolios">Portfolio</a></li>
          <li><a href="<?php echo base_url();?>admin/designer">Designers</a></li>
          <li><a href="<?php echo base_url();?>admin/expresshours">Expresshours(<?php echo express_count(); ?>)</a></li>
         <?php  if($usertype == 0){ ?>
           <li class="show-mob"><a href="<?php echo base_url();?>admin/myprofile_client">My Profile</a></li>
            <li class="show-mob"><a href="<?php echo base_url();?>admin/logout">Logout</a></li>  
         <?php  } ?>
             <?php  $ref_id = get_referral_id($user_id);
            if($ref_id==""){
             if($this->session->userdata('user_type') == 1 ){ ?>
            <li>
          <a href='<?php echo base_url();?>admin/designerCourt'><span>Design Court</span></a>
            </li> 
          <li>
          <a href='<?php echo base_url();?>admin/notifications'><span>Notifications</span></a>
            </li> 
             <li class="show-mob"><a href="<?php echo base_url();?>admin/myprofile_designer">My Profile</a></li>
            <li class="show-mob"><a href="<?php echo base_url();?>admin/logout">Logout</a></li>
          <?php  } } else { ?>
               <li class="show-mob"><a href="<?php echo base_url();?>admin/myprofile_referral">My Profile</a></li>
            <li class="show-mob"><a href="<?php echo base_url();?>admin/logout">Logout</a></li>
        <?php   }?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
 <script type="text/javascript">
      $(document).ready(function () {
      var ref_id = <?php echo get_referral_id($user_id);?>;
      if(ref_id !=""){
          $(".hide_referral").hide();
      }
    });


  </script>