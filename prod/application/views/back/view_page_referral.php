<!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    
                    <h3 class="page-title"> User
                        <small>Referral</small>
                    </h3>
                    <!-- END PAGE TITLE-->
                     <?php 
					$client_con = array();
					foreach ($country as $con){
						$client_con[$con->country_code]=$con->country_name;
					}
					?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Referral records</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
												<th> S.No </th>
                                                <th> Name </th>
                                                <th> Email </th>
                                                <th> Country </th>
                                                <th> Join Date </th>
                                                <th> Status </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0;
										foreach($referral_details as $dd) { $i = $i+1; ?>
                                            <tr>
                                                <td> <?php echo $i; ?> </td>
                                                <td> <?php echo ucwords($dd->referral_name); ?> </td>
                                                <td> <?php echo $dd->referral_email; ?> </td>
                                                <td> <?php echo $client_con[$dd->referral_country]; ?> </td>
                                                <td> <?php echo date ('d-M-Y',strtotime($dd->created_date)); ?> </td>
                                                <td calss="option"> <a href="<?php echo base_url();?>admin_panel/referral_single_view/<?php echo $dd->users_id; ?>">View</a> 
                                                  <!--   /  <a href="<?php //echo base_url();?>admin_panel/designer_transactions/<?php //echo $dd->users_id; ?>">Transactions </a> / <a href="<?php //echo base_url();?>admin_panel/designer_bonus/<?php //echo $dd->users_id; ?>">Designer Bonus</a> -->
                                                </td>
                                                
                                            </tr>
                                        <?php }?>
                                            
                                        </tbody>
                                    </table>
                                </div>
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
    