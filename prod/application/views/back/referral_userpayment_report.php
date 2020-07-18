<!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">                    
                    
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Referral User Payment Report
                        <small>Stacks</small>
                    </h3>
                    <!-- END PAGE TITLE-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Referral User Payment Reports</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                 <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> S.No </th>
                                                <th> User Name </th>
                                                <th> Referral Code </th>
                                                <th> Amount </th>
                                                <th> Created Date</th>
                                              
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
										if(!empty($referral_user_payment)){
										$i = 0;
										foreach($referral_user_payment as $cd) { 
											$i++; 
											/*$contest_name= !empty($cd->contest_title)?$cd->contest_title:$cd->org_name;*/
										?>
                                            <tr>
                                                <td> <?php echo $i; ?> </td>
                                               <!--  <td> <?php// echo ucwords($contest_name); ?> </td> -->
                                                <td> <?php echo $cd->user_name; ?> </td>
                                                <td> <?php echo $cd->ref_code; ?> </td>
                                                <td> <?php echo $cd->ref_amount; ?> </td>
                                                <td> <?php echo date("d-M-Y h:i:s",strtotime($cd->ref_created_date)); ?> </td>
                                              
                                            </tr>
                                        <?php }} else { echo "No Record.,";  } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            
        </div>
        <!-- END CONTAINER -->
        