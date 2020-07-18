<!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    
                    <h3 class="page-title">Referral Payment Rquest Completed 
                        <small></small>
                    </h3>
                    <!-- END PAGE TITLE-->
                 
			<?php echo $this->session->flashdata('update_msg');?>				 
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">records</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
								
                                <div class="portlet-body">
<table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                  <tr>
                    <th> S.No 
                    </th>
                    <th>Designer Name
                    </th>
                    <th>Paypal
                    </th>
                    <th>Request Date
                    </th>
                    <th>Final Transaction
                    </th>
                    <th>Release
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
					$i= 1; 
					foreach($request as $req) { 
					$ref_id=$req->ref_id;
					$req_date=$req->request_date;
					?>
                  <tr>
                    <td>
                      <?php echo $i++; ?> 
                    </td>
                    <td>
                      <?php echo username($ref_id);?> 
                    </td>
                    <td>
                      <?php echo paypal_referral_id($ref_id);?> 
                    </td>
                    <td>
                      <?php echo date("d/M/Y h:i a",strtotime($req_date));?> 
                    </td>
                    <td><?php echo $req->request_amount; ?></td>
                    <td>
                      <?php echo date("d/M/Y h:i a",strtotime($req->release_time));?>
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

	