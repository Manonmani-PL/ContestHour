<?php if(!empty($contest_list)){ ?>
<div class="row" style="background-color:rgba(244,242,237,0.4); border:1px solid rgba(0,0,0,0.1);">
    	<div class="col-md-12 col-lg-12">
        	<div class="contest-completed">
            	<p>Express Contests (<?php echo isset($count_contests)?$count_contests:0; ?>)</p>
            </div>
        </div>
    </div>
	
    <?php 
	$userid= is_user_logged_in();
	foreach ($contest_list as $con_list) { 
	if(!($con_list->upgrade_private_contest > 0)){
	?>
    <div class="row" style="border:1px solid rgba(0,0,0,0.1);">
    	<div class="col-md-6 col-lg-6">
        	<div class="Judging-Contests">
            
            	<p><a href="<?php echo base_url();?>contest/particular_contest/<?php echo $con_list->id; ?>">
				<b class="contest_list_title">
                	<?php
						if($con_list->contest_type=="logodesign" || $con_list->contest_type=="webdesign" || $con_list->contest_type=="movielogodesign")
							echo ucwords($con_list->org_name);
						else
							 echo ucwords($con_list->contest_title);
					?>
                </b></a>
				<?php if($con_list->upgrade_featured_contest > 0){?>
				<span><img src="<?php echo base_url()?>assets/images/feature.png" title="Featured Contest"></span>
				<?php } ?>
				<p><?php echo $con_list->business_description; ?></p>
            
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
        	<div class="Judging-Contests-prize">
            	<span><strong class="contest_list_price">Prize: Rs. <?php echo $con_list->contest_prize; ?></strong> | Entries: <?php echo designcount($con_list->id); ?></span>
				
				<?php if($con_list->close_date < date("Y-m-d H:i:s")){?>
					<p>Time Remaining: Finished</p>
				<?php } else{ ?>
					<p>Time Remaining: <?php echo remaining_time(date("Y-m-d H:i:s"),$con_list->close_date);?></p>
				<?php } ?>
				
				<p style="color:#333">Posted: <?php echo date("h:i A, d M, Y.",strtotime($con_list->published_date)); ?></p>
            </div>
        </div>
    </div>
	<?php 
	}
	elseif(($con_list->upgrade_private_contest>0) && ($userid!='')){
	?>
	<div class="row" style="border:1px solid rgba(0,0,0,0.1);">
    	<div class="col-md-6 col-lg-6">
        	<div class="Judging-Contests">
            
            	<p><a href="<?php echo base_url();?>contest/particular_contest/<?php echo $con_list->id; ?>"><b>
                	<?php
						if($con_list->contest_type=="logodesign" || $con_list->contest_type=="webdesign" || $con_list->contest_type=="movielogodesign")
							echo ucwords($con_list->org_name);
						else
							 echo ucwords($con_list->contest_title);
					?>
                </b></a>  
				<?php if($con_list->upgrade_featured_contest > 0){?>
				<span><img src="<?php echo base_url()?>assets/images/feature.png" title="Featured Contest"></span>
				<?php } ?>				
				<span><img src="<?php echo base_url()?>assets/images/private-contest.png" title="Private Contest"></span></p>
				</p>
				<p>Posted: <?php echo date("h:i A, d M, Y.",strtotime($con_list->published_date)); ?></p>
				<p><?php echo $con_list->business_description; ?></p>
            
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
        	<div class="Judging-Contests-prize">
            	<span><strong class="contest_list_price">Prize: Rs. <?php echo $con_list->contest_prize; ?></strong> | Entries: <?php echo designcount($con_list->id); ?></span>
				<?php if($con_list->close_date < date("Y-m-d H:i:s")){?>
					<p>Time Remaining: Finished</p>
				<?php } else{ ?>
					<p>Time Remaining: <?php echo remaining_time(date("Y-m-d H:i:s"),$con_list->close_date);?></p>
				<?php } ?>
            </div>
        </div>
    </div>
    <?php } } }else{?>
	
	<div class="row" style="border:1px solid rgba(0,0,0,0.1);">
    	<div class="col-md-12 col-lg-12">
			<p class="text-center" style="height: 100px;line-height: 100px;color: #ff1414;">Sorry!!! No Contest to display...</p>
        </div>
    </div>
	
    <?php }?>
    </div>