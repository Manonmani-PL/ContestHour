<!-- BEGIN CONTAINER -->
<div class="page-container">
   <?php require('include/side_bar.php'); ?>
   <!-- BEGIN CONTENT -->
   <div class="page-content-wrapper">
      <!-- BEGIN CONTENT BODY -->
      <div class="page-content">
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  <form class="form-horizontal" role="form" method="post">
                     <div class="form-body">
                        <h2 class="margin-bottom-20"> View Contest Info </h2>
                        <h3 class="form-section">Open Contest</h3>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Contest Title:</label>
                                 <div class="col-md-9">
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
                                 <label class="control-label col-md-3">Contest Type:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->contest_type; ?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Contest Prize:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->contest_prize; ?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Duration Hours:</label>
                                 <div class="col-md-9">
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
                                 <label class="control-label col-md-3">Published Date:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo date('d-M-Y',strtotime($cont_det[0]->published_date)); ?><strong></strong> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Close Date:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo date('d-M-Y',strtotime($cont_det[0]->close_date)); ?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Extras</h3>
                        <!-- For Web Design -->
                        <?php if($cont_det[0]->contest_type=="webdesign") { 
														$others = unserialize($cont_det[0]->other_details);
														$visual = unserialize($cont_det[0]->visual_style);?>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Ideas:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $visual['ideas']; ?> </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Org Name:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $visual['org_name'];?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Website Address:</label>
                                 <div class="col-md-9">
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
                                 <label class="control-label col-md-3">Describe Site:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $visual['describesite'];?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Designer Info:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $others['designersinfo'];?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!-- For Logo Design -->
                        <?php } elseif($cont_det[0]->contest_type=="logodesign"){
														$extras = unserialize($cont_det[0]->extras);
														?>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Ideas:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $extras['ideas'];?> </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Tag Line:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $extras['tagline'];?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Bacground Info:</label>
                                 <div class="col-md-9">
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
                                 <label class="control-label col-md-3">Visual Style:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->visual_style;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Other Details:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->other_details;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <!-- For Other Designs -->
                        <?php } elseif($cont_det[0]->contest_type=="tshirtdesign") {
														$visual = unserialize($cont_det[0]->visual_style);
														?>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Ideas:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $visual['ideas'];?> </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Size:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->size;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Bacground Info:</label>
                                 <div class="col-md-9">
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
                                 <label class="control-label col-md-3">Other Details:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->other_details;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <?php } else { 
													
														$others = unserialize($cont_det[0]->other_details);
														
														
														?>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Org Name:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->org_name;?> </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Size:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->size;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Bacground Info:</label>
                                 <div class="col-md-9">
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
                                 <label class="control-label col-md-3">Visual Style:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $cont_det[0]->visual_style;?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label col-md-3">Other Details:</label>
                                 <div class="col-md-9">
                                    <p class="form-control-static">
                                       <?php echo $others['designersinfo'];?> </p>
                                 </div>
                              </div>
                           </div>
                           <!--/span-->
                        </div>
                        <?php } ?>
                     </div>
                     <div class="form-actions">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="row">
                                 <div class="col-md-offset-3 col-md-9">

                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6"> </div>
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