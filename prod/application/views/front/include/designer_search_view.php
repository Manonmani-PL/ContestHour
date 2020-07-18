<div class="container">
	<?php 
	if(!empty($result)){ foreach($result as $res){
		$uid=$res->users_id;
		$wincount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'design_status'=>1));
		$finalcount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'final_status'=>1));
		$Participatcount=$this->Common_model->counts('designs','distinct(contest_id)',array('designer_id'=>$uid));
	?>
	<div class="row" style="padding:10px; border:1px solid rgba(0,0,0,0.1);"> 
		<a href="<?php echo base_url()."admin/designer_portfolio/".$res->id ;?>">
    	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
        	<div class="col-sm-2 col-xs-12">
            	<div class="d-pro-img"><img src="<?php if(!empty($res->designer_profile)) { echo base_url();?>uploads/designer_profile/<?php echo $res->designer_profile; } else { echo base_url();?>assets/image/d-pro-img.png<?php }?>" width="79px" height="83"  /></div>
            </div>
            <div class="col-sm-3 col-xs-3">
            	<div class="d-pro-name"><?php echo $res->designer_name;?></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
        	<div class="col-sm-3 col-xs-3">
            	<div class="won-rate"><?php echo $res->rank;?></div>
            </div>
        	<div class="col-sm-3 col-xs-3">
            	<div class="won-rate"><?php echo $wincount?></div>
            </div>
            <div class="col-sm-3 col-xs-3">
            	<div class="final-rate"><?php echo $finalcount ?></div>
            </div>
            <div class="col-sm-3 col-xs-3">
            	<div class="participate-rate"><?php echo $Participatcount ?></div>
            </div>
        </div>
		</a>
    </div>
    <?php } } else {?>
    <div class="row" style="padding:10px; border:1px solid rgba(0,0,0,0.1);">
     	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
        	
            	No records available..
            
     	</div>
    </div>
    <?php } ?> 
</div>