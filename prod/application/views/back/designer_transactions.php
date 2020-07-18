<!-- BEGIN CONTAINER -->
<div class="page-container">
   <?php require('include/side_bar.php'); ?>        
   <!-- BEGIN CONTENT -->
   <div class="page-content-wrapper">
      <!-- BEGIN CONTENT BODY -->
      <div class="page-content">
         <h3 class="page-title"> Designer
            <small>Transactions</small>
         </h3>
         <!-- END PAGE TITLE-->
         <div class="row">
            <div class="col-md-12">
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <div class="portlet light bordered">
                  <div class="portlet-title">
                     <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Designer Transactions History</span>
                     </div>
                     <div class="tools"> </div>
                  </div>
                  <div class="portlet-body">
                     <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                           <tr>
                            <th>Sno</th>
							<th>Date</th>
							<th>Detail</th>
							<th>Amount ($)</th>
							<th>Balance ($)</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
							  $i=1;
                              if($request!=""){
                              	foreach($request as $req) { 
                           ?>
                           <tr>
                              <td> <?php echo $i++; ?> </td>
							  <td> <?php echo date("d/M/Y h:i a",strtotime($req->trans_date));?> </td>
							  <td> <?php echo $req->reward_msg;?> </td>
							  <td> <?php echo (($req->trans_value>0)?"+":'').$req->trans_value;?> </td>
							  <td> <?php echo $req->trans_new_balance;?> </td>
                           </tr>
                           <?php 
								}
							  }
						   ?>
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