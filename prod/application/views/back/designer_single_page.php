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
                                                        <h2 class="margin-bottom-20"> Designer Info </h2>
                                                        <h3 class="form-section"><?php echo ucwords($result->designer_name); ?></h3>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Name:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"> <?php echo $result->designer_name; ?> </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Email:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"> <?php echo $result->designer_email; ?> </p>
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
                                                                        <p class="form-control-static"> <?php echo $client_con[$result->designer_country]; ?> </p>
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
															<div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Current Balance:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"> 
																		<?php 
																		if($balance=="")
																		{
																			echo"0";
																		}
																			else
																			{
																				echo $balance;
																			}
																			?> 
																		 </p>
                                                                    </div>
                                                                </div>
                                                            </div>
															<div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Warning Point:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"><?php echo $warning; ?>  </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                                        <div class="row">
															<?php if($result->designer_country!='IN'){?>
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
                                                        <!--/row-->
                                                        <h3 class="form-section">Contest Details</h3>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                                <div class="portlet light bordered">
                                                                    <div class="portlet-title">
                                                                        <div class="caption font-dark">
                                                                            <i class="icon-settings font-dark"></i>
                                                                            <span class="caption-subject bold uppercase">designer records</span>
                                                                        </div>
                                                                        <div class="tools"> </div>
                                                                    </div>
                                                                    <div class="portlet-body">
                                                                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th> Contest Name </th>
                                                                                    <th> Total Design </th>
                                                                                    <th> Designer Status </th>
                                                                                    <th> Start Date </th>
                                                                                    <th> End Date </th>
                                                                                    <th> Contest Status </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
																			<?php 
																			if(!empty($records))
																			{
																			 foreach($records as $des) 
																			 {
																				 
						
													$query=$this->Common_model->status($des->designer_id,$des->contest_id);
																$status="";
																if(empty($query))
																{
																	$status="Not Qualified";
																}
																else
																{
																	foreach($query as $q)
																{		
																	
																	if($q->final_status==1)
																				 {
																					 $status="Finalist";
																					 
																				 }
																		else if($q->design_status==1)
																				 {
																					 $status="Win";
																					break;
																				 }
																																																																											
						}
						}
						
																			?>
                                                                                <tr>
                                                                                    <td><?php echo (!empty($des->contest_title))?$des->contest_title:$des->org_name;  ?></td>
                                                                                    <td><?php echo $des->design_count;  ?></td>
                                                                                    <td><?php	echo $status; ?>
																					</td>
                                                                                    <td><?php echo $des->published_date; ?></td>
                                                                                    <td><?php echo $des->close_date; ?></td>
                                                                                    <td> Completed </td>
                                                                                </tr>
                                                                                
																			<?php  }} 
																			
																			 
																				?>
																		
                                                                           
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    	</div>
                                                       
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-offset-3 col-md-9">
                                                                       <!-- <button type="submit" class="btn green">
                                                                            <i class="fa fa-pencil"></i> Edit</button>-->
                                                                        
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
    