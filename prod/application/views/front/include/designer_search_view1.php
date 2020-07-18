<style>
a {
  color: #0a0a0a;
  transition: 0.5s;
}

.list-header-name {
    color: #713365;
    font-weight: 900;
    margin: 0px;
}

.design-item .desginer-pic1 {
    position: initial;
    width: 150px;
    height: 150px;
    right: -75px;
    bottom: -50px;
    overflow: hidden;
    text-align: center;
    border-radius: 50%;
    box-shadow: 5px 5px 20px 0 rgba(0, 0, 0, 0.2);
}
</style>
<div class="container min-height" >
	<?php 
	if(!empty($result)){ foreach($result as $res){
		$uid=$res->users_id;
		$wincount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'design_status'=>1));
		$finalcount=$this->Common_model->get_records_count('designs',array('designer_id'=>$uid,'final_status'=>1));
		$Participatcount=$this->Common_model->counts('designs','distinct(contest_id)',array('designer_id'=>$uid));
	?>
 <div class="item-block wow fadeInUp">
            <a href="<?php echo base_url()."admin/designer_portfolio/".$uid ;?>">
                <div class="row">
                    <div class="col-md-3 design-item">
                        <div class="desginer-pic1 ">
                             <img src="<?php if(!empty($res->designer_profile)) { echo base_url();?>uploads/designer_profile/<?php echo $res->designer_profile; } else { echo base_url();?>assets/images/designer-signup.png<?php }?>">
                            
                        </div>

                    </div>
                    
                    <!-- <div class="col-md-6"> -->
                        <div class="col-md-3">
                        
                             <h3 class="list-header-name"><?php echo $res->designer_name; ?></h3>
                             <?php $rating = get_designer_rating($uid); 
                            // var_dump($rating);exit;
                             
                             foreach($rating as $star){
                                if($star->design_count !="0"){
                                 $avg=($star->design_rating/$star->design_count);
                                
                                 $avg1 =round($avg); 
                                    
                                ?>
                              <!----Star-->
                                        <div id="rateYo_<?php echo $star->design_id; ?>"></div>
                                         <script>
                                            $(function () {
                                         
                                          $("#rateYo_<?php echo $star->design_id; ?>").rateYo({
                                            fullStar: true,
                                            rating : <?php echo $avg1; ?>,
                                             spacing: "10px",
                                             starWidth: "25px",
                                            //readOnly: true
                                            
                                          }).on("rateyo.set", function (e, data) { 
                                              updateStar(<?php echo $star->design_id; ?>,data.rating);
                                          });
                                         
                                        });
                                        </script>
                                       <!----Star-->
                            <?php } else { echo "No Star Ratings"."<br>"; } } 
                             ?>
                             <span> <?php echo $wincount;?> Wining Designs</span><br>
                             <span style="background-color: #674269;color: #fff;border-color: #713365;  border-radius: 2px;">Invite</span> 
                    </div>
                    <?php $images = get_design_image($uid);
                    foreach($images as $img){ ?>
                        <div class="col-md-2 col-6 list-icons">
                     <img class="imagesize" style="height: 132px!important; width: 150px!important;" src="<?php echo base_url(); ?>uploads/designer_designs/<?php echo $img->design_name;?>">
                    </div>
                    <?php }
                    ?>
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