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
 <main id="main" class="non-intro">
  <section id="contests-designs">
      <div class="container">
      <div id="change_contain">	
      			 <div class="row design-list">
				 <div class="col-md-4 design-item">
				 	 <?php if($desiner_total_designs >0){   ?>
           
				 	<div class="design-img" >
            <img style="height: 270px" src="<?php if(!empty($user_details[0]->designer_profile)){ echo base_url();?>uploads/designer_profile/<?php echo $user_details[0]->designer_profile; } else { echo base_url();?>assets/images/designer-signup.png<?php }?>"class="desinger_profile_img">  
            
				 		<!-- <img src="<?php echo base_url();?>assets/images/testimonial-2.jpg">   -->
				 		<span><?php echo $designer_rank[0]->rank;?> <?php echo ordinal_suffix($designer_rank[0]->rank);?></span>	
				 	</div>	
				 <?php } ?>
				  <h3> ACHIEVEMENTS </h3>
				   <ul style="list-style-type:none;line-height:32px; padding:0px;	">
                            <li><i style=" color:#fff;background:#f4b321;padding:5px;border-radius:100px;" class="fa fa-star" aria-hidden="true"></i> GOLD WINS <span style="font-size:22px;font-weight:bold;float:right;"><?php echo "-". $wincount?></span></li>
							 
                            <li><i style="color:#fff;background:#bcbcbc;padding:5px;border-radius:100px;" class="fa fa-star" aria-hidden="true"></i> SILVER WINS <span style="font-size:22px;font-weight:bold;float:right;"><?php echo "-" .$finalcount-$wincount?></span></li>
                            <li><i style=" color:#fff;background:#006837;padding:5px;border-radius:100px;" class="fa fa-star" aria-hidden="true"></i> FINALISTS <span style="font-size:22px;font-weight:bold;float:right;"><?php echo "-" .$finalcount;?></span></li>
                        </ul>
      			 </div>	
      			  <div class="col-md-4 design-item">
      			 	<h3 style="padding:5px;margin-top:20px;" class="section-header">
                            <?php echo ucwords($user_details[0]->designer_name); ?>
                        </h3>
                        <div style="background:#f2f2f2;padding:10px;height: 208px;width: 100%;margin-top:10px;display:table; border-radius: 10px;">
                            <span style="display:table;"><b>About Me</b></span>
                            <?php echo $user_details[0]->designer_intro;?>
                        </div> 
                         <div style="background:#f2f2f2;padding:10px;height: 208px;width: 100%;margin-top:10px;display:table; border-radius: 10px;">
                            <ul style="list-style-type:none;line-height:32px;margin:0px;padding:0px; height:100px;">
                                <li><i class="fa fa-arrow-circle-right"></i>
                                    <?php echo $Participatcount;?> Contests Entered </li>
                                <!--<li><i class="fa fa-clock-o"></i> Last Login 3 Hours, 50 Minutes ago</li>-->
                                <li><i class="fa fa-exclamation-triangle" style="color:red;"></i>
                                    <?php echo $warning_count?> Warning </li>
                            </ul>
                        </div> 	
      			 </div>	
      			 <div class="col-md-4 design-item">
      			 	 	<div style="background:#f2f2f2;padding:10px; margin-top:20px; display:table; width:100%; border-radius: 10px">
                           <!--  <span style="display:table;"><b>TOTAL EARNING</b></span> -->
                            <p>Total Earning<b style="float:right;">$ <?php if($totalearn==""){echo"0";}else{echo $totalearn;}?></b></p>
                            <p>Current Balance:<b style="float:right;">$ <?php if($balance==""){echo"0";}else{echo $balance;}?></b></p>
                       	</div>
                       	<div style="background:#f2f2f2; padding:10px;margin-top:10px; display:table;width:100%; border-radius: 10px; height: 390px;">
                            <span style="display:table;"><b>EXPERIENCE</b></span>
                            <ul style="display:block;list-style:none;padding:0;text-align:left; ">
                               <?php 
                                foreach( $contest_type as $tmp){?>
                                <li style="display: inline-block;margin: 5px 0px;border: 1px solid #ccc;padding: 2px 5px;"><?php echo $tmp->contest_type; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
      			 </div>	

      			 </div>	

	 			
 </div>      	
 </div>
 </section>  
 <section id="contests-designs">
			<div class="container">
			<div class="row">
				<div class="col-lg-12 section-header">
				PORTFOLIO
			</div>
				</div>
<div class="row">
  
<div class="listing-block" style="width: 100%; margin-top:10px;">
 
     <?php
  if(isset($designs) && !empty($designs)){
    foreach ($designs as $res){ 
  ?> 
          
  <div class="item-block wow fadeInUp">
        <div class="row">
          <div class="col-md-5">

            <div class="contest-title list-icons_new" >
               <img width="250px" src="<?php echo base_url();?>uploads/designer_designs/<?php echo $res->design_name; ?>" >
            </div>
            </div>
         
       
          
         <!--  <div class="col-md-6 col-6 list-icons"> -->
            <div class="col-md-7 list-icons">
            <b "><?php echo contestname($res->contest_id);?></b>
            <span class="design-ratting">
            <?php
             if(isset($res->design_rating) && !empty($res->design_rating)) {
            for($x=1;$x<=$res->design_rating;$x++) {  
            echo '<i class="fa fa-star"></i>';
             } } else { echo'-'; }?>
          </span>
           
             <p>"<?php echo contest_testimoney($res->contest_id);?>"</p>
             <div class="user_review">
         <div class="col-sm-12 col-xs-12 zeropadding">
          <div class="commend">
             <span><?php echo time_elapsed_string(contest_testimoneytime($res->contest_id));?></span>
          </div>
         </div>
        </div> 
          </div>
         
        </div>
          </div>  
          <?php 
    } 
  } else {
  ?>
    <div class="row" style="padding:10px; border:1px solid rgba(0,0,0,0.1);">
      <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
          
              No records available..
            
      </div>
    </div>
  </div>
  <?php } ?>
   
   <!--  <div class="row">
 <?php //echo pagination("admin/portfolios",$total_contestlist,20);?>
          </div> -->
     </div>

				</div>
      </div>
			</section>
    
 </main>
			
				