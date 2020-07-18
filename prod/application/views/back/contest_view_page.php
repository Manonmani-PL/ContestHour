<style>
.color-box{
	width:30px; 
	height: 30px; 
	margin-left:10px; 
	display:inline-block;
}

.slidecontainer{
	margin-top: -5px;
}

.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 13px;
    border-radius: 10px !important;   
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    border-radius: 50%; 
    background: #2b3643;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #2b3643;
    cursor: pointer;
}
</style>

<!-- BEGIN CONTAINER -->
<div class="page-container">
   <?php require('include/side_bar.php'); ?>
   <!-- BEGIN CONTENT -->
   <div class="page-content-wrapper">
      <!-- BEGIN CONTENT BODY -->
      <div class="page-content">
         <div class="row">
		 <?php echo $this->session->flashdata('update_msg');?>
            <div class="col-md-12">
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  <form class="form-horizontal" role="form" method="post">
                     <div class="form-body">
					 <?php
						//Find industry name
						$ins = array();
						foreach ($industries as $in){
							$ins[$in->id]=$in->industry_name;
						}
						$status= $cont_det[0]->status; 
						switch($status){
							case "open":
								$label="info"; 
								break;
							case "judging":
								$label="warning"; 
								break;
							default:
								$label="success";
						}
					 ?>
                        <h2 class="margin-bottom-20"> View Contest Info </h2>
                        <h3 class="form-section">Contest Status - <span class="label label-<?php echo $label?>"> <?php echo ucwords($status);?>  </span></h3>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Contest Title:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php 
										if($cont_det[0]->contest_type != 'logodesign' && $cont_det[0]->contest_type != 'webdesign' && $cont_det[0]->contest_type != 'movielogodesign' ){ echo $cont_det[0]->contest_title;} else { echo $cont_det[0]->org_name; }  
                                       ?> 
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Contest Type:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php 
                                 $contest_category1 = get_category_type($cont_det[0]->id);
                                  if(is_numeric($cont_det[0]->contest_type)){
                                                foreach ($contest_category1 as $con_category){
                                                echo  $con_category; }
                                                } else { 
                                                 echo $cont_det[0]->contest_type;
                                                } 
                                       //echo $cont_det[0]->contest_type; ?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Contest Prize:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->contest_prize; ?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Duration Hours:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->duration_hours; ?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Published Date:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo date('d-M-Y',strtotime($cont_det[0]->published_date)); ?><strong></strong> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Close Date:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo date('d-M-Y',strtotime($cont_det[0]->close_date)); ?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Package Name:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo get_contest_pacakgename($cont_det[0]->id); ?><strong></strong> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4"></label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Extras</h3>
                        <!-- For Web Design -->
                        <?php 
						if($cont_det[0]->contest_type=="webdesign"){ 
							$others = unserialize($cont_det[0]->other_details);
							$visual = unserialize($cont_det[0]->visual_style);
							
						?>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Ideas:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $visual['ideas']; ?> </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Org Name:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $visual['org_name'];?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Website Address:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $visual['website_address'];?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Describe Site:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $visual['describesite'];?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Designer Info:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $others['designersinfo'];?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!-- For Logo Design -->
                        <?php 
						} 
						elseif($cont_det[0]->contest_type=="logodesign"){
							$extras = unserialize($cont_det[0]->extras);
							
						?>
						<div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Business Description:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
									<?php echo $cont_det[0]->business_description;?>
									</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Industry:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
										<?php echo $ins[$cont_det[0]->industry]; ?>
									</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Ideas:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $extras['ideas'];?> </p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Colors:</label>
                                 <div class="col-md-8">
									<span class="color-box" style="background: <?php echo $extras['color1'];?>"></span>
									<span class="color-box" style="background: <?php echo $extras['color2'];?>"></span>
									<span class="color-box" style="background: <?php echo $extras['color3'];?>"></span>
									<span class="color-box" style="background: <?php echo $extras['color4'];?>"></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Tag Line:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $extras['tagline'];?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Bacground Info:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->background_info;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Visual Style:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->visual_style;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Other Details:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->other_details;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
						<div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label class="control-label col-md-2">Style Sliders:</label>
                                 <div class="col-md-8">
									<div class="row">
										<div class="col-md-3">
											FEMININE
										</div>
										<div class="col-md-6">
											<div class="slidecontainer">
												<input type="range" min="1" max="100" value="<?php echo $extras['slider1'];?>" class="slider" id="myRange">
											</div>
										</div>
										<div class="col-md-3">
											MASCULINE
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											SIMPLE
										</div>
										<div class="col-md-6">
											<div class="slidecontainer">
												<input type="range" min="1" max="100" value="<?php echo $extras['slider2'];?>" class="slider" id="myRange">
											</div>
										</div>
										<div class="col-md-3">
											COMPLEX
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											MODEST
										</div>
										<div class="col-md-6">
											<div class="slidecontainer">
												<input type="range" min="1" max="100" value="<?php echo $extras['slider3'];?>" class="slider" id="myRange">
											</div>
										</div>
										<div class="col-md-3">
											LUXURY
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											PLAYFUL
										</div>
										<div class="col-md-6">
											<div class="slidecontainer">
												<input type="range" min="1" max="100" value="<?php echo $extras['slider4'];?>" class="slider" id="myRange">
											</div>
										</div>
										<div class="col-md-3">
											SERIOUS
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											MODERN
										</div>
										<div class="col-md-6">
											<div class="slidecontainer">
												<input type="range" min="1" max="100" value="<?php echo $extras['slider5'];?>" class="slider" id="myRange">
											</div>
										</div>
										<div class="col-md-3">
											VINTAGE
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											SPORTY
										</div>
										<div class="col-md-6">
											<div class="slidecontainer">
												<input type="range" min="1" max="100" value="<?php echo $extras['slider6'];?>" class="slider" id="myRange">
											</div>
										</div>
										<div class="col-md-3">
											ELEGANT
										</div>
									</div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <!-- For Other Designs -->
                        <?php 
						}
						elseif($cont_det[0]->contest_type=="tshirtdesign"){
							$visual = unserialize($cont_det[0]->visual_style);
						?>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Ideas:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $visual['ideas'];?> </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Size:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->size;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Bacground Info:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->background_info;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Specific Color:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $visual['specific_color'];?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Other Details:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->other_details;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <?php 
						} 
						else {
							$others = json_decode($cont_det[0]->other_details);
						?>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Org Name:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->org_name;?> </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Size:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->size;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Bacground Info:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->background_info;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Visual Style:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->visual_style;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Other Details:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo $others['designersinfo'];?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <?php } ?>
						<h3 class="form-section">Payment Status </h3>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-4">Payment Type:</label>
                                 <div class="col-md-8">
                                    <p class="form-control-static">
                                       <?php echo ($cont_det[0]->pay_option==0)?"Partital Payment":"Fully Paid";?> 
									</p>
                                 </div>
                              </div>
                           </div>
						   <?php if($cont_det[0]->pay_option==0):?>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <div class="col-md-8">
                                    <a href="<?php echo base_url()?>admin_panel/change_Paymentstatus/<?php echo $cont_det[0]->id;?>" class="btn btn-primary check_alert">Change Payment Status To Fully Paid
									</a>
                                 </div>
                              </div>
                           </div>
						   <?php endif;?>
                        </div>
                     </div>
                  </form>
                  <!-- END FORM-->
               </div>
               <!-- END EXAMPLE TABLE PORTLET-->
            </div>
         </div>
      </div>
      <!-- END CONTENT BODY -->
   </div>
   <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<script>
$(document).ready(function(){
	$(".check_alert").click(function(){
		return confirm('Do you want to change payment status?');
	});
});
</script>