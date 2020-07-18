 <!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <?php 
					$client_con = array();
					foreach ($country as $con){
						$client_con[$con->country_code]=$con->country_name;
					}
					$user_id=$this->session->userdata('user_id');
 
			$warning=$this->Common_model->get_records_count('contest_warning',array('designer_id'=>$user_id));
					?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
             <form class="form-horizontal" role="form" method="post">
                 <div class="form-body">
                 <h2 class="margin-bottom-20"> Referral Info </h2>
                <h3 class="form-section"><?php echo ucwords($result->referral_name); ?></h3>
                 <div class="row">
                 <div class="col-md-6">
                <div class="form-group">
                <label class="control-label col-md-3">Name:</label>
                 <div class="col-md-9">
                  <p class="form-control-static"> <?php echo $result->referral_name; ?> </p>
                    </div>
                     </div>
                     </div>
                  <!--/span-->
               <div class="col-md-6">
               <div class="form-group">
                 <label class="control-label col-md-3">Email:</label>
                  <div class="col-md-9">
                    <p class="form-control-static"> <?php echo $result->referral_email; ?> </p>
                     </div>
                    </div>
                      </div>
                         <!--/span-->
                     </div>
                     <!--/row-->
                     <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">
                     <label class="control-label col-md-3">Country:</label>
                     <div class="col-md-9">
                       <p class="form-control-static"> <?php echo $client_con[$result->referral_country]; ?> </p>
                        </div>
                    </div>
                      </div>
                       <!--/span-->
                      <div class="col-md-6">
                      <div class="form-group">
                     <label class="control-label col-md-3">Join Date:</label>
                     <div class="col-md-9">
                       <p class="form-control-static"> <?php echo date("d-M-Y",strtotime($result->created_date)); ?> </p>
                         </div>
                           </div>
                          </div>
                         <!--/span-->
                         </div>
                          <!--/row-->
                    <div class="row">
					<?php if($result->referral_country!='IN'){?>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label class="control-label col-md-3">Paypal Email:</label>
                     <div class="col-md-9">
                     <p class="form-control-static"> <?php echo $result->paypal_email; ?> </p>
                     </div>
                    </div>
                    </div>
					<?php } else{ ?>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label class="control-label col-md-3">Account Number:</label>
                      <div class="col-md-9">
                     <p class="form-control-static"> <?php echo $result->account_number; ?> </p>
                      </div>
                      </div>
                      </div>
                      <div class="col-md-6">
                     <div class="form-group">
                    <label class="control-label col-md-3">Bank Name:</label>
                     <div class="col-md-9">
                      <p class="form-control-static"> <?php echo $result->bank_name; ?> </p>
                      </div>
                       </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                     <label class="control-label col-md-3">Bank Branch:</label>
                     <div class="col-md-9">
                       <p class="form-control-static"> <?php echo $result->bank_branch; ?> </p>
                       </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                         <label class="control-label col-md-3">IFSC Code:</label>
                         <div class="col-md-9">
                       <p class="form-control-static"> <?php echo $result->ifsc_code; ?> </p>
                        </div>
                          </div>
                           </div>
                         <div class="col-md-6">
                         <div class="form-group">
                        <label class="control-label col-md-3">Account Holder Name:</label>
                         <div class="col-md-9">
                         <p class="form-control-static"> <?php echo $result->account_holder; ?> </p>
                          </div>
                          </div>
                           </div>
								<?php }?>
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
    