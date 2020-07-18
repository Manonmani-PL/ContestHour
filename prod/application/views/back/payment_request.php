<!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');} ?>
                    <h3 class="page-title"> Designer Release Paymen Requests
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
                                        <span class="caption-subject bold uppercase">Payment Resquests</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> S.No </th>
                                                <th> Contest Title </th>
                                                <th> Contest Type </th>
                                                <th> Contest Prize </th>
                                                <th> Total Amount </th>
                                                <th> Published Date </th>
                                                <th> Close Date </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0;
										foreach($contest_details as $cd) {  $i = $i+1; ?>
                                            <tr>
												<td><?php echo $i; ?></td>
                                                <td><?php if($cd->contest_type != 'logodesign' && $cd->contest_type != 'webdesign' && $cd->contest_type != 'movielogodesign' ){ echo $cd->contest_title;} else { echo $cd->org_name; } ?> </td>
                                                <td><?php echo $cd->contest_type; ?> </td>
                                                <td><?php echo $cd->contest_prize; ?> </td>
                                                <td><?php echo $cd->total_amount; ?> </td>
                                                <td><?php echo date('d-M-Y',strtotime($cd->published_date)); ?> </td>
                                                <td><?php echo date('d-M-Y',strtotime($cd->close_date)); ?> </td>
                                                <td><a href="<?php echo base_url();?>admin_panel/new_contest_view/<?php echo $cd->id; ?>">View</a> </td>                                                
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
    