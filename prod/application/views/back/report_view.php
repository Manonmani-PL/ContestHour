<!-- BEGIN CONTAINER -->
<div class="page-container">
<?php require('include/side_bar.php'); ?>        
<!-- BEGIN CONTENT -->
<?php 
   $rtype=$result->report_type;
   if($rtype==0){
   $designer_selectop="Someone copied my logo design";
   }
   else if($rtype==1)
   {
   $designer_selectop="Use of copyrighted images";
   }
?>
<div class="page-content-wrapper">
   <!-- BEGIN CONTENT BODY -->
   <div class="page-content">
      <div class="row">
         <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet-body form">
               <!-- BEGIN FORM-->
               <div class="form-body">
                  <h2 class="margin-bottom-20">View Report Info </h2>
                  <h3 class="form-section">Report</h3>
                  <div class="row">
					<div class="col-md-12">
						<h4><b><?php echo "Contest Name: ".contestname($result->contest_id); ?></b></h4>
						<h5><b><?php echo "Report Message: ".$result->report_messsage; ?></b></p>
					</div>
					
                    <div class="col-md-6">
                           <p >Reporter design:</p>
                           <div class="col-md-12">
						   <div style="width:250px; display:block;">
							<?php 
								
								 if($rtype==0){
								?>
								<?php  if(empty($rep_design->design_name)) {  echo "<b>No Image</b>"; } else {?>
								
                              <img src="<?php echo base_url();?>uploads/designer_designs/<?php echo $rep_design->design_name;?>" style="width:100%;">
								<?php
								}
								 }
								else if($rtype==1){
								?>
								 
                              <img src="<?php echo $result->reporter_design;?>" style="width:100%;">
								<?php 
								}
								?>
                             </div>
                              <h5><b><?php echo $designer_selectop ?></b></h5>
                              <p><?php echo "Designer id:".$result->report_designer; ?></p>
                              <p><?php echo "Designer Name:".username($result->report_designer); ?></p>
							  <?php if(empty($rep_design->design_id)) {
								  echo "<b>No Design Id</b>";
							  } else { ?>
                              <p><?php echo ($rtype==0)?"Design id:".$rep_design->design_id:"";?></p>
							  <?php } ?>
                           </div>
                     </div>
                     <!--/span-->
                     <div class="col-md-6">
                           <p>Copy design:</p>
                           <div class="col-md-12">
							<div style="width:250px; display:block;">	
                              <img src="<?php echo base_url();?>uploads/designer_designs/<?php echo $cp_design->design_name;?>" style="width:250px; display:block;">
							 </div> 
                              <p><?php echo "Designer id:".$cp_design->designer_id; ?></p>
                              <p><?php echo "Designer name:".username($cp_design->designer_id);?></p>
                              <p><?php echo "Design id:".$cp_design->design_id;?></p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php if($result->report_status==0){?>
				  <!--/row-->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <?php										
                              $admin_id=$this->session->userdata('admin_id');
                           ?>	
                           <form action="<?php echo base_url();?>Admin_panel/report_warning" method="post">
                              <center>										
                                 <label class="report1"><input type="radio" class="radiooption" id="rdo1_a" name="report_result" value="0">ACCEPT</label>
                                 <label class="report1"><input type="radio" class="radiooption" id="rdo1_a" name="report_result" value="1">REJECT</label>
                              </center>
                              <center><textarea name="tarea" id="tarea" rows="6" cols="50"></textarea> </center>
							  <input type="hidden" name="contestid" value="<?php echo $result->contest_id;?>">
                              <input type="hidden" name="cp_designer_id" value="<?php echo $cp_design->designer_id;?>">
							  <input type="hidden" name="cp_design_id" value="<?php echo $cp_design->design_id;?>">
                              <input type="hidden" name="report_id" value="<?php echo $result->id ?>">
                              <input type="hidden" name="reporter_id" value="<?php echo $result->report_designer;?>">
                              <input type="hidden" name="reporter_design_id" value="<?php echo $result->reporter_design;?>">
                              <center><input type="submit" class="btn btn-success" value="submit"></center>
                           </form>
                        </div>
                     </div>
                  </div>
                  <!--/row-->
				  <?php } else{?>
					<div class="row">
                     <div class="col-md-12">
						<h4><b>Judgement Result:</b> <?php echo ($result->report_judgement ==0)?"Accepted":"Rejected"; ?></h4>
						<h4><b>Judgement Reason:</b> <?php echo $result->judgement_reason ?></h4>
					 </div>	
					</div>	
				  <?php }?>
                  <!-- END FORM-->
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