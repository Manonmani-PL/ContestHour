<!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">                    
                    
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> User
                        <small>Client</small>
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
                                        <span class="caption-subject bold uppercase">client records</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                <?php if($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> S.No </th>
                                                <th> Name </th>
                                                <th> Email </th>
                                                <th> Country </th>
                                                <th> Join Date </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
											$i = 0;
										foreach($client_details as $cd) { $i = $i+1; ?>
                                            <tr>
                                                <td> <?php echo $i; ?> </td>
                                                <td> <?php echo ucwords($cd->name); ?> </td>
                                                <td> <?php echo $cd->email; ?> </td>
                                                <td> <?php echo (!empty($cd->country))?$client_con[$cd->country]:""; ?> </td>
                                                <td> <?php echo date ('d-M-Y',strtotime ($cd->created_date)); ?> </td>
                                                <td> <a href="<?php echo base_url();?>admin_panel/client_single_view/<?php echo $cd->users_id; ?>">View</a> </td>
                                            </tr>
                                        <?php }?>
                                            
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