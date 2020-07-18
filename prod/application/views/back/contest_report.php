<!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">                    
                    
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Contest
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
                                        <span class="caption-subject bold uppercase">Contest Reports</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                 <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> S.No </th>
                                                <th> Contest Name </th>
                                                <th> Contest Price </th>
                                                <th> Listing Fee </th>
                                                <th> Duration Fee </th>
                                                <th> Featured Fee </th>
                                                <th> Private Fee </th>
                                                <th> Total </th>
                                                <th> Designer's Prize </th>
                                                <th> Balance </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
										if(!empty($contest_list)){
										$i = 0;
										foreach($contest_list as $cd) { 
											$i++; 
											$contest_name= !empty($cd->contest_title)?$cd->contest_title:$cd->org_name;
										?>
                                            <tr>
                                                <td> <?php echo $i; ?> </td>
                                                <td> <?php echo ucwords($contest_name); ?> </td>
                                                <td> <?php echo $cd->contest_fee; ?> </td>
                                                <td> <?php echo $cd->listing_fee; ?> </td>
                                                <td> <?php echo $cd->duration_fee; ?> </td>
                                                <td> <?php echo $cd->featured_fee; ?> </td>
                                                <td> <?php echo $cd->private_fee; ?> </td>
                                                <td> <?php echo $cd->total_fee; ?> </td>
                                                <td> <?php echo $cd->contest_reward; ?> </td>
                                                <td> <?php echo $cd->contest_balance; ?> </td>
                                            </tr>
                                        <?php }} ?>
                                            
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
<script type="text/javascript">        
function do_change(id) {
		var inactive=$("#inactive").val();
		var active=$("#active").val(); 
		
		if(confirm("Do you want to change status??")){
		$.ajax
			({
				type:'POST',
				data:{inactive:inactive,active:active},
				url:'<?php echo base_url();?>admin_panel/change_client_status/'+id,
				success:function(data)
				{
					alert("Status has been successfully changed");
					window.location.reload(true);
				}
			});
		}
}
</script>        