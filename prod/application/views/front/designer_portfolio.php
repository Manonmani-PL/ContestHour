<style>
.star-rating {
    margin-top: 0px;
    margin-bottom: 10px;margin-left:15px;
}
.nopadding{padding:0px;}
</style>

<div class="gap-low"></div>
<?php
	$uid=$user_details[0]->user_id;
	$wincount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'design_status'=>1));
	$finalcount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'final_status'=>1));
	$Participatcount=$this->Common_model->counts('designs','distinct(contest_id)',array('designer_id'=>$uid));
	$warning_count=$this->Common_model->get_records_count('contest_warning',array('designer_id'=>$uid));
?>
<div class="minheight">
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-xs-12" style="margin-top:25px;">

                    <div class="col-md-4 col-lg-4 nopadding">
                        <div class="d-pro-img-big">
                            <img width="100%" style="width:100%;" src="<?php if(!empty($user_details[0]->designer_profile)){ echo base_url();?>uploads/designer_profile/<?php echo $user_details[0]->designer_profile;} else { echo base_url();?>assets/images/designer-signup.png<?php }?>" class="desinger_profile_img">   
                            <?php if($desiner_total_designs >0){?>
                            <div class="status-rank"><i style="margin-top: -60px; position: absolute; display: inline-block; font-size: 19px; color: rgb(255, 255, 255); margin-left: 7px;"><?php echo $designer_rank[0]->rank;?><span style="font-size:13px"><?php echo ordinal_suffix($designer_rank[0]->rank)?></span></i> </div>
							<?php } ?>
                        </div>
                        
                        <h3> ACHIEVEMENTS </h3>
                        <ul style="list-style-type:none;line-height:32px; padding:0px;	">
                            <li><i style=" color:#fff;background:#f4b321;padding:5px;border-radius:100px;" class="fa fa-star" aria-hidden="true"></i> GOLD WINS <span style="font-size:22px;font-weight:bold;float:right;"><?php echo $wincount?></span></li>
							<!-- 
                            <li><i style="color:#fff;background:#bcbcbc;padding:5px;border-radius:100px;" class="fa fa-star" aria-hidden="true"></i> SILVER WINS <span style="font-size:22px;font-weight:bold;float:right;"><?php echo $finalcount-$wincount?></span></li>-->
                            <li><i style=" color:#fff;background:#006837;padding:5px;border-radius:100px;" class="fa fa-star" aria-hidden="true"></i> FINALISTS <span style="font-size:22px;font-weight:bold;float:right;"><?php echo $finalcount;?></span></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <h3 style="background:#ceccc6;padding:10px;margin:0px;">
                            <?php echo ucwords($user_details[0]->designer_name); ?>
                        </h3>
                        <div style="background:#f2f2f2;padding:10px;min-height: 270px;width: 100%;margin-top:10px;display:table;">
                            <span style="display:table;"><b>About Me</b></span>
                            <?php echo $user_details[0]->designer_intro;?>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <div style="background:#f2f2f2;padding:10px; display:table; width:100%;">
                            <span style="display:table;"><b>EXPERIENCE</b></span>
                            <ul style="display:block;list-style:none;padding:0;text-align:left;">
                               <?php 
                                foreach( $contest_type as $tmp){?>
                                <li style="display: inline-block;margin: 5px 0px;border: 1px solid #ccc;padding: 2px 5px;"><?php echo $tmp->contest_type; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
						
                        <div style="background:#f2f2f2; padding:10px;margin-top:10px; display:table;width:100%;">
                            <ul style="list-style-type:none;line-height:32px;margin:0px;padding:0px;">
                                <li><i class="fa fa-arrow-circle-right"></i>
                                    <?php echo $Participatcount;?> Contests Entered </li>
                                <!--<li><i class="fa fa-clock-o"></i> Last Login 3 Hours, 50 Minutes ago</li>-->
                                <li><i class="fa fa-exclamation-triangle" style="color:red;"></i>
                                    <?php echo $warning_count?> Warning </li>
                            </ul>
                        </div>
                    </div>
                </div>
		</div>
	</div>
</section>
		
<section>
	<div class="container" style="background-color:#f4f2ed; margin-top:15px;">
		<div class="row">
			<div class="col-md-4 col-lg-4">
				<div class="contest-head">
					<h4>PORTFOLIO</h4>
				</div>
			</div>
			<div class="col-md-4 col-lg-4"></div>
		</div>
	</div>
</section>

<section>
	<div class="container">
	<?php
	if(isset($designs) && !empty($designs)){
		foreach ($designs as $res){ 
	?>
	<div class="col-md-12 col-lg-12"  style="border-bottom:1px solid #ccc; padding-bottom: 10px;">
	   <div class="logo_design_model">
		  <div class="logo_image" style="float:left; width:20%;">
			 <img src="<?php echo base_url();?>uploads/designer_designs/<?php echo $res->design_name; ?>" style="width:100%">
		  </div>
		  <div style="padding:1%; float:left;width:75%;">
			 <div class="col-sm-12 col-xs-12 zeropadding">
				<b style="float:left;padding-right:15px;"><?php echo contestname($res->contest_id);?></b>
				<div class="star-rating">
				   <div class="rating-container rating-md rating-animate">
					  <div class="clear-rating " title="Clear"><i class="glyphicon glyphicon-minus-sign"></i></div>
					  <input for="28" id="input-21b" readonly="readonly" value="<?php echo ($res->design_rating);?>" class="rating checkrate hide" min="0" max="5" step="1" data-size="md" type="number">
				   </div>
				</div>
			 </div>
			 <p>"<?php echo contest_testimoney($res->contest_id);?>"</p>
			 <div class="user_review">
				 <div class="col-sm-12 col-xs-12 zeropadding">
					<div class="commend" style="text-align:left;">
					   <span><?php echo time_elapsed_string(contest_testimoneytime($res->contest_id));?></span>
					</div>
				 </div>
			  </div> 
		  </div>
	   </div>
	</div>
	<?php 
		} 
	} 
	?>
	</div>
</section>
</div>
<div class="gap-low"></div>