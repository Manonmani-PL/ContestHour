<!-- BEGIN CONTAINER -->
<div class="page-container">            
<?php require('include/side_bar.php'); ?>        
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    
                    <h3 class="page-title"> New Contests
                        <small></small>
                    </h3>
                    <!-- END PAGE TITLE-->
                    
                    <div class="row">
                        <div class="col-md-12">
						
						<div class="col-md-6">
											<div class="form-group form-md-line-input">
                                                <label class="col-md-3 control-label" for="form_control_1">Posted From
                                                    <span class="required" aria-required="true">*</span>
                                                </label>
                                                <div class="col-md-5">
                                                    <select class="form-control" id="postedfrom">
														<option value="1" <?php echo isset($posted) && $posted == 1?"selected":"";?>>Contesthours</option>
														<option value="2" <?php echo isset($posted) && $posted == 2?"selected":"";?>>Bestbuylogo</option>
													</select>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            </div>
						<div class="row"></div>
						
						
						
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
												<th> Sno </th>
                                                <th> Contest Title </th>
                                                <th> Client</th>
                                                <th> Contest Type </th>
                                                <th> Package Name </th>
                                                <th> Prize </th>
                                                <th> Total</th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0;
										foreach($contest_details as $cd) { $i = $i+1;  ?>
                                            <tr>
											<td> <?php echo $i; ?> </td>
                                                <td> <?php if($cd->contest_type != 'logodesign' && $cd->contest_type != 'webdesign' && $cd->contest_type != 'movielogodesign' ){ echo $cd->contest_title;} else { echo $cd->org_name; } ?> </td>
                                                <td> <?php echo username($cd->client_id); ?> </td>
                                                <td> <?php 
                                                 $contest_category1 = get_category_type($cd->id);
                                                 if(is_numeric($cd->contest_type)){
                                                foreach ($contest_category1 as $con_category){
                                                echo  $con_category; }
                                                } else { 
                                                 echo $cd->contest_type;
                                                }
                                                //echo $cd->contest_type; ?> </td>
                                                <td><?php echo get_contest_pacakgename($cd->id); ?></td>
                                                <td> <?php echo $cd->contest_prize; ?> </td>
                                                <td> <?php echo $cd->total_amount; ?> </td>
                                                <td> <a href="<?php echo base_url();?>admin_panel/draft_contest_view/<?php echo $cd->id; ?>">View</a> 
                                                 <a href="<?php echo base_url();?>admin_panel/draft_contest_delete/<?php echo $cd->id; ?>">Delete</a></td>
                                                
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
   <script>   
 $(document).ready(function(){
	$(document).on("change", "#postedfrom", function(e) {
		window.location.href = "<?php echo base_url();?>admin_panel/draft_contest/"+$(this).val();
	});
 });
 </script>    