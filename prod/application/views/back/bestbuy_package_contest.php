<!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
				
                    <h3 class="page-title"> Bestbuylogo Payment Package Price Setting
                        <!--<small>Change Password</small>-->
                    </h3>
					
                    <div class="row">
                        <div class="col-md-12">
                        <div class="portlet light portlet-fit portlet-form bordered">
                         <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
							<div class="portlet-body">
                                    <!-- BEGIN FORM-->
                                    <form action="<?php echo base_url();?>admin_panel/add_bestbuy_package_cost" class="form-horizontal" id="form_sample_1" method="post">
                                        <div class="form-body">
											<!--
											<div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Minimum contest prize
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" required placeholder="" id="min_price" name="min_price" value="<?php if(isset($setval->min_price) && !empty($setval->min_price)){ echo $setval->min_price; }else{ echo 0; } ?>" onkeypress="return isNumberKey(event)"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Minimum contest prize</span>
                                                </div>
                                            </div>
											-->
											<div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1"><b>Contest Fee</b></label>
											</div>
											<div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Listing Fee
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" required placeholder="" id="list_fee" name="list_fee" value="<?php if(isset($setval->list_fee) && !empty($setval->list_fee)){ echo $setval->list_fee; }else{ echo 0; } ?>"  onkeypress="return isNumberKey(event)"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Contest hours Designs flat</span>
                                                </div>
                                            </div>
											
											<div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Express 24 Hours
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" required placeholder="" id="24hours" name="24hours" value="<?php if(isset($setval->hours24) && !empty($setval->hours24)){ echo $setval->hours24; }else{ echo 0; } ?>"  onkeypress="return isNumberKey(event)"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">For 24 Hours</span>
                                               
                                                </div>
                                            </div>
											
											<div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Express 48 Hours
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                  
                                                    <input type="text" class="form-control" required placeholder="" id="48hours" name="48hours" value="<?php if(isset($setval->hours48) && !empty($setval->hours48)){ echo $setval->hours48; }else{ echo 0; } ?>"  onkeypress="return isNumberKey(event) "/>
                                                    <div class="form-control-focus"> </div>
													
                                                    <span class="help-block">For 48 Hours</span>
                                                </div>
                                            </div>
											<div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1"><b>Contest Duration</b></label>
											</div>	
											<div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">3 Days
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" required placeholder="" id="3days" name="3days" value="<?php if(isset($setval->days3) && !empty($setval->days3)){ echo $setval->days3; }else{ echo 0; } ?>" onkeypress="return isNumberKey(event)"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">For  3 Days -Minimum contest Prize </span>                                               
                                                </div>
                                            </div>
											
											<div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">4 Days
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                 
                                                    <input type="text" class="form-control" required placeholder="" id="4days" name="4days" value="<?php if(isset($setval->days4) && !empty($setval->days4)){ echo $setval->days4; }else{ echo 0; } ?>" onkeypress="return isNumberKey(event)"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">For 4 Days -Minimum contest Prize</span>
												</div>
                                            </div>
											
											<div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">5 Days
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                 
                                                    <input type="text" class="form-control" required placeholder="" id="5days" name="5days" value="<?php if(isset($setval->days5) && !empty($setval->days5)){ echo $setval->days5; }else{ echo 0; } ?>" onkeypress="return isNumberKey(event)"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">For 5 Days -Minimum contest Prize</span>
												</div>
                                            </div>
											
											<div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">6 Days
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                 
                                                    <input type="text" class="form-control" required placeholder="" id="6days" name="6days" value="<?php if(isset($setval->days6) && !empty($setval->days6)){ echo $setval->days6; }else{ echo 0; } ?>" onkeypress="return isNumberKey(event)"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">For 6 Days -Minimum contest Prize</span>
												</div>
                                            </div>
											
											<div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">7 Days
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                 
                                                    <input type="text" class="form-control" required placeholder="" id="7days" name="7days" value="<?php if(isset($setval->days7) && !empty($setval->days7)){ echo $setval->days7; }else{ echo 0; } ?>" onkeypress="return isNumberKey(event)"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">For 7 Days -Minimum contest Prize</span>
												</div>
                                            </div>
											<br>
											<p><p>
											<h4>PROJECT UPDATE DETAILS</h4>
											
                                           <div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Top Designers
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" required placeholder="" id="top_des" name="top_des" value="<?php if(isset($setval->top_des) && !empty($setval->top_des)){ echo $setval->top_des; }else{ echo 0; } ?>" onkeypress="return isNumberKey(event)"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Top Designers  cost</span>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Choose Designers
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="" name="design_fee" value="<?php if(isset($setval->design_fee) && !empty($setval->design_fee)){ echo $setval->design_fee; }else{ echo 0; } ?>" onkeypress="return isNumberKey(event)"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Choose Designers Cost</span>
                                                </div>
                                            </div>
                                            
											 <div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Celebrity Contest
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="" name="celebrity_fee" value="<?php if(isset($setval->celebrity_fee) && !empty($setval->celebrity_fee)){ echo $setval->celebrity_fee; }else{ echo 0; } ?>" onkeypress="return isNumberKey(event)"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Celebrity Cost</span>
                                                </div>
                                            </div>
											
											 
											 <div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Private Contest
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="" name="priv_fee" value="<?php if(isset($setval->priv_fee) && !empty($setval->priv_fee)){ echo $setval->priv_fee; }else{ echo 0; } ?>" onkeypress="return isNumberKey(event)"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Private Contests Cost</span>
                                                </div>
                                            </div>
											
																					 
											 <div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Featured Contest
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control" placeholder="" name="featured_fee" value="<?php if(isset($setval->featured_fee) && !empty($setval->featured_fee)){ echo $setval->featured_fee; }else{ echo 0; } ?>" onkeypress="return isNumberKey(event)"/>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Featured Contest Cost</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Add</button>
                                                    <button type="reset" class="btn default">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>
                                </div>
                           </div>
                      </div>
                  </div>
              </div>
          </div>
		  
<script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}    
</script>

  
 
 
 

