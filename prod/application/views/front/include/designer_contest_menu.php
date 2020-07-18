<!-- <div class="gap-low"></div>
<div class="minheight"/> -->
<!-- <div class="container">
	<div class="row">
    	<div class="col-md-1 col-lg-1"></div>
        <div class="col-md-10 col-lg-10 ">
        	<div class="col-sm-4">
                <div class="contest-link">
                	<li><a href="<?php //echo base_url();?>admin/openContests" class="<?php //echo($content=='front/open-contests')?'active':''; ?>">OPEN CONTESTS&nbsp;&nbsp;<span></span></a></li>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contest-link">
                	<li><a href="<?php //echo base_url();?>admin/judgingContests" class="<?php //echo($content=='front/judging_contests')?'active':''; ?>">JUDGING CONTESTS&nbsp;&nbsp;<span></span></a></li>
                </div>
            </div>
			
			<div class="col-sm-4">
                <div class="contest-link">
                	<li><a href="<?php //echo base_url();?>admin/contestCompleted" class="<?php //echo($content=='front/contest-completed')?'active':''; ?>">COMPLETED CONTESTS&nbsp;&nbsp;<span></span></a></li>
                </div>
            </div>
         </div>
        <div class="col-md-1 col-lg-1"></div>
    </div>
</div> -->
<section id="intro" class="contest-list">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade">
        <img src="<?php echo base_url();?>assets/images/home_bg.jpg" alt="" title="" />
      </div>
      <div class="row intro-msg">
        <div class="container">
            <ul class="row contest-type-btns">
                <li class="col-md-4">
                    <a href="<?php echo base_url();?>admin/contestCompleted" class="<?php echo($content=='front/contest-completed1')?'active':''; ?>">COMPLETED CONTESTS</a>
                </li>
                <li class="col-md-4">
                     <a href="<?php echo base_url();?>admin/judgingContests" class="<?php echo($content=='front/judging_contests1')?'active':''; ?>">JUDGING CONTESTS</a>
                </li>
                 <li class="col-md-4">
                     <a href="<?php echo base_url();?>admin/openContests" class="<?php echo($content=='front/open-contests1')?'active':''; ?>">OPEN CONTESTS</a>
                </li>
            </ul>
        </div>
      </div>
    </div>
  </section><!-- #intro -->
