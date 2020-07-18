<!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">                    
                    
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Referral Report
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
                                        <span class="caption-subject bold uppercase">Referral Reports</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                 <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> S.No </th>
                                                <th> User_name </th>
                                                <th> Contest Id </th>
                                                <th> Total Amount </th>
                                                <th> Referral Code</th>
                                              
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                    $coupon_code = get_records_referral_report();
										if(!empty($coupon_code)){
										$i = 0;
										foreach($coupon_code as $cd) { 
											$i++; 
											/*$contest_name= !empty($cd->contest_title)?$cd->contest_title:$cd->org_name;*/
										?>
                                            <tr>
                                                <td> <?php echo $i; ?> </td>
                                               <!--  <td> <?php// echo ucwords($contest_name); ?> </td> -->
                                                <td> <?php echo username($cd->user_id); ?> </td>
                                                <td> <?php echo $cd->contest_id; ?> </td>
                                                <td> <?php echo get_contest_total($cd->contest_id); ?> </td>
                                                <td> <?php echo $cd->ref_code; ?> </td>
                                              
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