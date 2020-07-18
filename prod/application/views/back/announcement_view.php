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
                                        <span class="caption-subject bold uppercase">Announcement View</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
												<th> S.No </th>
                                                <th> Tittle </th>
                                                <th> Message </th>
												<th> Edit </th>
												<th> Delete </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0;
										foreach($announcement as $cd) { $i = $i+1; ?>
                                            <tr>
												<td> <?php echo $i; ?> </td>
                                                <td> <?php echo $cd->title; ?> </td>
                                                <td> <?php echo $cd->message; ?> </td>
												<td> <a href="<?php echo base_url();?>admin_panel/announcements/<?php echo $cd->id; ?>">View</a> </td>
												<td> <a href="<?php echo base_url();?>admin_panel/delete_announcements/<?php echo $cd->id; ?>">Delete</a> </td>
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
    