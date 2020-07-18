<style>
.star-rating {
	display:inline;
}
</style>
<?php $this->load->view('front/include/left_side_menu_designer');?>
<div class="col-sm-9">
    <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
    <?php if($this->session->flashdata('valid_error')){ echo $this->session->flashdata('valid_error'); } ?>
	
    <h3 class="dashboard_title">Portfolio</h3>
	<div class="row" style="padding-bottom:40px;">
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
				<b style="float:left;padding-right:15px; padding-bottom:10px;"><?php echo contestname($res->contest_id);?></b>
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
		  <!--
		  <div class="user_review">
			 <div class="col-sm-12 col-xs-12 zeropadding">
				<div class="commend" style="text-align:right;">
				   <span><?php echo time_elapsed_string($res->entry_time);?></span>
				</div>
			 </div>
		  </div>-->
	   </div>
	</div>
	<?php 
		} 
	} 
	?>
	</div> 
	
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