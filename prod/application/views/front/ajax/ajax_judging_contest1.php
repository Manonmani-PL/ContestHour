 <section id="contests">
      <div class="container">
      <div id="change_contain">	
   	
        <div class="listing-block">
		   <?php 
	$contest_category= contest_category();
	$userid= is_user_logged_in();
	if(isset($contest_list) && !empty($contest_list)){
	foreach ($contest_list as $con_list) { 
	if(!($con_list->upgrade_private_contest > 0)){
	?>		
          <div class="item-block wow fadeInUp">
			<a href="<?php echo base_url();?>contest/particular_contest/<?php echo $con_list->id; ?>">
				<div class="row">
					<div class="col-md-12">
						<div class="contest-title">
							<span class="price">$<?php echo $con_list->contest_prize; ?></span> <?php 
							if($con_list->contest_type=="logodesign" || $con_list->contest_type=="webdesign" || $con_list->contest_type=="movielogodesign")

							echo substring($con_list->org_name,'12');

						else
							 echo substring($con_list->contest_title,'12');
					?>
							<div class="item-labels">
								<span class="contest-category"><?php echo $contest_category[$con_list->contest_type];?></span>
								<?php if($con_list->upgrade_featured_contest > 0){?>
								<span class="contest-features"><i class="fa fa-lock"></i></span>
								<?php } ?>
								<?php if($con_list->pay_option== 1){?>
								<span class="contest-features"><i class="fa fa-star"></i></span>
								<?php } ?>
							</div>
						</div>
					</div>
					<!-- <div class="d-block d-sm-none text-center">
						<img src="<?php echo base_url();?>assets/images/testimonial-2.jpg" class="item-design">
					</div> -->
					<div class="col-md-6">
						
						<p class="contest-desc"> <?php 
								echo substring($con_list->business_description,'50'); ?></p>
					</div>
					<div class="col-md-3 col-6 list-icons">
						<img class="list-icons" src="<?php echo base_url();?>assets/images/icon-clock.svg"> 
						<span>
							<?php 
							if($con_list->close_date < date("Y-m-d H:i:s")){
								echo "Finished Date";
							} else {
							 	$remain = remaining_days(date("Y-m-d "),$con_list->close_date);
								echo $remain." Days Remaining";
						}
							?></span>	
					</div>
					<div class="col-md-3 col-6 list-icons">
						<img class="list-icons" src="<?php echo base_url();?>assets/images/icon-design.svg"> 
						<span><?php echo designcount($con_list->id); ?> Designs</span>	
					</div>
				</div>
			</a>
          </div>		
         <?php } 
         	elseif(($con_list->upgrade_private_contest>0) && ($userid!='')){ 
         ?>
          <div class="item-block wow fadeInUp">
			<a href="<?php echo base_url();?>contest/particular_contest/<?php echo $con_list->id; ?>">
				<div class="row">
					<div class="col-md-12">
						<div class="contest-title">
							<span class="price">$<?php echo $con_list->contest_prize; ?></span><?php
						if($con_list->contest_type=="logodesign" || $con_list->contest_type=="webdesign" || $con_list->contest_type=="movielogodesign")
								echo ucwords(substring($con_list->org_name,'12'));

						else
							 echo ucwords(substring($con_list->contest_title,'12'));					
					?>
							<div class="item-labels">
								<span class="contest-category"><?php echo $contest_category[$con_list->contest_type];?></span>
								<?php if($con_list->upgrade_featured_contest > 0){?>
								<span class="contest-features"><i class="fa fa-lock"></i></span>
								<?php } ?>
								<?php if($con_list->pay_option== 1){?>
								<span class="contest-features"><i class="fa fa-star"></i></span>
								<?php } ?>
							</div>
						</div>
					</div>
					<!-- <div class="d-block d-sm-none text-center">
						<img src="<?php echo base_url();?>assets/images/testimonial-2.jpg" class="item-design">
					</div> -->
					<div class="col-md-6">
						
						<p class="contest-desc"> <?php 
						echo substring($con_list->business_description,'50'); ?></p>
					</div>
					<div class="col-md-3 col-6 list-icons">
						<img class="list-icons" src="<?php echo base_url();?>assets/images/icon-clock.svg"> 
						<span>
							<?php 
							if($con_list->close_date < date("Y-m-d H:i:s")){
								echo "Finished Date";
							} else {
							 	$remain = remaining_days(date("Y-m-d "),$con_list->close_date);
								echo $remain." Days Remaining";
						}
							?></span>	
					</div>
	
				</div>
			</a>
          </div>	
     
            <?php } } } else { ?>

           <div class="row" style="border:1px solid rgba(0,0,0,0.1);">
    	<div class="col-md-12 col-lg-12">
			<p class="text-center" style="height: 407px;line-height: 50px; line-width: 100px; color: #ff1414;">Sorry!!! No Contest to display...</p>
        </div>
    </div>

            <?php }?>
        </div>
        </div>
      
		
      </div>
    </section><!-- #about -->