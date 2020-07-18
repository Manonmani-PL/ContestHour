<!-- BEGIN CONTAINER -->
<div class="page-container">
   <?php require('include/side_bar.php'); ?>
   <!-- BEGIN CONTENT -->
   <div class="page-content-wrapper">
      <!-- BEGIN CONTENT BODY -->
      <div class="page-content">

         <h3 class="page-title"> Report
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
                        <span class="caption-subject bold uppercase">Report records</span>
                     </div>
                     <div class="tools"> </div>
                  </div>
                  <?php echo $this->session->flashdata('report_accept');?>
                  <div class="portlet-body">
                     <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                           <tr>
                              <th> S.No </th>
                              <th>Deigner Name </th>
                              <th>contest Id</th>
                              <th> Designer Id </th>
                              <th> Design Id </th>
                              <th> Copy design Id </th>
                              <th> copy designer Id </th>
                              <th>copy designer name</th>
                              <th> Action </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
								$i = 0;
								foreach($rep as $cd) { $i = $i+1; 
									$report_type=$cd->report_type;
									$message=$cd->report_messsage;
									$uid=$cd->report_designer;
									$udesid=$cd->reporter_design;
									$contest_id=$cd->contest_id;
									$name=$this->Common_model->get_record('designer_table','',array('users_id'=>$uid));
									$uname=$name->designer_name;
							
									$cp=$cd->copy_design;
									$cdr=$cd->copy_designer;
									$cpdes=$this->Common_model->get_record('designer_table','',array('users_id'=>$cdr));
									$cp_designername=$cpdes->designer_name;
							?>
                           <tr>
                              <td>
                                 <?php echo $i; ?> </td>
                              <td>
                                 <?php echo $uname;?> </td>
                              <td>
                                 <?php echo $contest_id ;?> </td>
                              <td>
                                 <?php echo $uid; ?> </td>
                              <td>
                                 <?php echo $udesid; ?>
                              </td>
                              <td>
                                 <?php echo $cp; ?> </td>
                              <td>
                                 <?php echo $cdr; ?> </td>
                              <td>
                                 <?php echo $cp_designername ?>
                              </td>
                              <td> <a href="<?php echo base_url();?>admin_panel/report_data_view/<?php echo $cd->id;?>">View</a> </td>

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