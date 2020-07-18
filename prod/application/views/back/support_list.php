<!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    
                    <h3 class="page-title"> Open Contests
                        <small></small>
                    </h3>
                    <!-- END PAGE TITLE-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">contest records</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
												<th> S.No </th>
                                                <th> Support Type </th>
                                                <th> Subject </th>
                                                <th> Message </th>
                                                <th> Date</th>
                                                <th> Attachment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
										$support_list= supporttypes();
										$i = 0;
										foreach($support as $cd) { $i = $i+1; ?>
                                            <tr>
												<td> <?php echo $i; ?> </td>
                                                <td> <?php echo $support_list[$cd->support_type]?> </td>
                                                <td> <?php echo $cd->subject; ?> </td>
                                                <td> <?php echo $cd->message; ?> </td>
                                                <td> <?php echo date("d M,Y",strtotime($cd->createdtime)); ?> </td>
                                                <td>
													<?php if(!empty($cd->support_file)){?>
													<a href="<?php echo base_url();?>/uploads/supportfiles/<?php echo $cd->support_file;?>" target="_blank">Download</a>
													<?php } ?>
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
    