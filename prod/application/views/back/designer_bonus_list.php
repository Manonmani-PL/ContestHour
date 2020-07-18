<!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    
                    <h3 class="page-title"> Designer Bonus
                        <small>List</small>
                    </h3>
                    <!-- END PAGE TITLE-->
                   
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Bonus Payments</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
												<th> S.No </th>
                                                <th> Name </th>
                                                <th> Bonus </th>
                                                <th> Message </th>
                                                <th> Date </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0;
										foreach($list as $tmp) { $i = $i+1; ?>
                                            <tr>
                                                <td> <?php echo $i; ?> </td>
                                                <td> <?php echo username($tmp->designer_id); ?> </td>
                                                <td> <?php echo $tmp->bonus_price; ?> </td>
                                                <td> <?php echo $tmp->bonus_message; ?> </td>
                                                <td> <?php echo date ('d-M-Y',strtotime($tmp->createdtime)); ?> </td>
                                                
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
    