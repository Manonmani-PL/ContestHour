<!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    
                    
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Password settings 
                        <!--<small>Change Password</small>-->
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    
                    <div class="row">
                        <div class="col-md-12">
                        <div class="portlet light portlet-fit portlet-form bordered">
                         <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
							<div class="portlet-body">
                                    <!-- BEGIN FORM-->
                                    <form action="<?php echo base_url(); ?>admin_panel/admin_change_password" class="form-horizontal" id="form_sample_1" method="post">
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                            
											<div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Old Password
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="password" class="form-control" required placeholder="" id="old_pass" name="old_pass">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Enter your Old password</span>
                                                </div>
                                            </div>
											
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">New Password
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="password" class="form-control" placeholder="" id="new_pass" name="new_pass">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Enter your New password</span>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Re-enter
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="password" class="form-control" placeholder="" name="re_pass">
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Re-enter your new password</span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Change</button>
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
  
 