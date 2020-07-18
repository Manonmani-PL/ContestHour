<!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">                    
                    
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Email User
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
                                        <span class="caption-subject bold uppercase"><?php echo $grouptitle->group_title;?></span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                <?php if($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> S.No </th>
                                                <th> Email </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
										$i = 1;
										foreach($grouplist as $tmp) {
										?>
                                            <tr>
										<td> <?php echo $i++; ?> </td>
                                                <td> <?php echo $tmp->email_id; ?> </td>
                                                <td> <a href="#">Send Mail</a> </td>
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