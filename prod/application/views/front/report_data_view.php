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
<div class="container" style="margin-top:15px;">
   <div class="row">
      <div class="col-md-4 col-lg-4">
         <div class="contest-head">
            <h4>Designer Report List</h4>
         </div>
      </div>
      <div class="col-md-12 col-lg-12">
         <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <div class="form-body">
               <h2 class="margin-bottom-20">View Report Info </h2>
               <h3 class="form-section">Report</h3>
               <div class="row">
                  <div class="col-md-12">
                     <h4><b><?php echo "Contest Name: ".contestname($result->contest_id); ?></b></h4>
                     <h5>
                     <b><?php echo "Report Message: ".$result->report_messsage; ?></b></p>
                  </div>
                  <div class="col-md-6">
                     <p >Reporter design:</p>
                     <div class="col-md-12">
                        <div style="width:250px; display:block;">
                           <?php 
                              if($rtype==0){
                              ?>
                           <img src="<?php echo base_url();?>uploads/designer_designs/<?php echo $rep_design->design_name;?>" style="width:100%;">
                           <?php
                              }
                              else if($rtype==1){
                              ?>
                           <img src="<?php echo $result->reporter_design;?>" style="width:100%;">
                           <?php 
                              }
                              ?>
                        </div>
						<div style="margin:20px 0px">
                        <p><b><?php echo $designer_selectop ?></b></p>
                        <p><?php echo "Designer id:".$result->report_designer; ?></p>
                        <p><?php echo "Designer Name:".username($result->report_designer); ?></p>
                        <p><?php echo ($rtype==0)?"Design id:".$rep_design->design_id:"";?></p>
						</div>
                     </div>
                  </div>
                  <!--/span-->
                  <div class="col-md-6">
                     <p>Copy design:</p>
                     <div class="col-md-12">
                        <div style="width:250px; display:block;">	
                           <img src="<?php echo base_url();?>uploads/designer_designs/<?php echo $cp_design->design_name;?>" style="width:250px; display:block;">
                        </div>
						<div style="margin:20px 0px">
                        <p><?php echo "Designer id:".$cp_design->designer_id; ?></p>
                        <p><?php echo "Designer name:".username($cp_design->designer_id);?></p>
                        <p><?php echo "Design id:".$cp_design->design_id;?></p>
						</div>
                     </div>
                  </div>
               </div>
            </div>
            <?php if($result->report_status==0){?>
            <!--/row-->
            <div class="row">
               <div class="col-md-12">
					<h5><b>Status:</b>OPEN</h5>
               </div>
            </div>
            <!--/row-->
            <?php } else{?>
            <div class="row">
               <div class="col-md-12">
                  <h5><b>Judgement Result:</b> <?php echo ($result->report_judgement ==0)?"Accepted":"Rejected"; ?></h5>
                  <h5><b>Judgement Reason:</b> <?php echo $result->judgement_reason ?></h5>
               </div>
            </div>
            <?php }?>
            <!-- END FORM-->
         </div>
      </div>
   </div>
</div>
<div class="gap"></div>